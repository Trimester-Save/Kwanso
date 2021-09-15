<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class AppModel extends Model
{

    function isCheckedIn()
    {
        $data = $this->input->post();
        $db = Database::connect();
        $builder = $db->table('checkedin_patients');
        $builder->where('is_checkedin', 1);
        $builder->where('uid', $data['uid']);
        $builder->where('delete_flag', 0);
        $query = $builder->get()->getRowArray();

        $room = $query['room'];
        $is_checkedin = $query['is_checkedin'];
        switch ($room) {
            case "1":
                $roomhex = "#7F6786";
                break;
            case "2":
                $roomhex = "#B9004C";
                break;
            case "3":
                $roomhex = "#2F4D66";
                break;
            case "4":
                $roomhex = "#CB483B";
                break;
            case "5":
                $roomhex = "#952B32";
                break;
            case "6":
                $roomhex = "#2B688D";
                break;
            case "7":
                $roomhex = "#98BE1D";
                break;
            case "8":
                $roomhex = "#FAD443";
                break;

        }
        if (isset($query)) {

            $get_checkedin = array(
                "room_data" => array("room" => $room,
                    "hex" => empty($roomhex) ? "" : $roomhex),
                "is_checkedin" => $is_checkedin ? true : false
            );


            return $get_checkedin;

        } else {
            return array(
                "room_data" => array("room" => "0",
                    "hex" => empty($roomhex) ? "" : $roomhex),
                "is_checkedin" => false
            );
        }

    }

    //============ UPDATE CHECKING PATIENT =======================//
    function checkIn()
    {
        $db = Database::connect();
        $data = array(
            "uid" => $_POST['uid'],
            "aid" => $_POST['appt_id']
        );
        $builder = $db->table('checkedin_patients');
        $builder->insert($data);
        return $builder->insertID;
    }

    function reply()
    {
        $db = Database::connect();
        $chatBuilder = $db->table('chat c');
        $chatBuilder->select('c.id');
        $chatBuilder->where('c.uid', $_POST['uid']);
        $query = $chatBuilder->get()->getRowArray();

        $QuickRepliesBuilder = $db->table('quick_replies');
        $QuickRepliesBuilder->select('message');
        $QuickRepliesBuilder->where('id', $_POST['reply']);
        $res = $QuickRepliesBuilder->get()->getRowArray();

        if (!empty($query)) {
            $chatsBuilder = $db->table('chats');
            $chatsBuilder->set(['last_message' => $res['message'], 'is_read' => 0]);
            $chatsBuilder->where('id', $query['id']);
            $chatsBuilder->update();

            $builder = $db->table('chat_messages');
            $builder->set(['chat_id' => $query['id'], 'message' => $res['message'], 'is_sent' => 0]);
            $builder->insert();
            return $builder->insertID;
        } else {
            $chatsBuilder = $db->table('chats');
            $chatsBuilder->set(['uid' => $_POST['uid'], 'last_message' => $res['message']]);
            $chatBuilder->insert();
            $chatsBuilder->insertID;

            $builder = $db->table('chat_messages');
            $builder->set(['chat_id' => $insert_id, 'message' => $res['message'], 'is_sent' => 0]);
            $builder->insert();

            return $builder->insertID;
        }
    }

    function getemail()
    {
        $db = Database::connect();
        $builder = $db->table('users');
        $builder->where('email', $_POST['email']);
        $builder->where('delete_flag', 0);
        return $builder->countAllResults();
    }

    function add_users()
    {
        $db = Database::connect();
        $builder = $db->table('users');
        $builder->set($_POST);
        $builder->insert();
        if ($id = $builder->insertID) {
            $userBuilder = $db->table('users');
            $userBuilder->select('id,full_name,email,latitude,longitude');
            $userBuilder->where('id', $id);
            $userBuilder->where('delete_flag', 0);
            $res = $userBuilder->get()->getRowArray();

            $subject = "Welcome to Kwanso";
            $message = '<html>
                            <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
                                <style>
                                    table{
                                    border:1px solid #0bad11 ;
                                    width:80%;
                                    }
                                    p{  padding-left: 5%;}
                                    h3{ padding-left: 2%;}
                                    </style>
                            </head>
                            <body>
                                <table>
                                    <tr>
                                         <th style="background:#0bad11;color:white;font-size:2em;width:100%;">
                                              Kwanso App
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                          <h3>Hey "' . $_POST['full_name'] . '"</h3>
                                           <p>Thank you for Registering with us on Kwanso app</p>
                                           <p>You can use this app in many ways</p>
                                           <p>See your next appointments</p>
                                           <p>Daily Reminders</p>
                                           <p>Quick and easy check-in</p>
                                           <small>We welcome you to our Platform.</small>
                                        </td>
                                    </tr>
                                </table>
                            </body>
                      </html>';
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: Kwanso <no-reply@kwanso.com>' . "\r\n";

            mail($_POST['email'], $subject, $message, $headers);

        }

        return $res;
    }

    //=============***********=============//
    function getCheckin()
    {
        $db = Database::connect();
        $builder = $db->table('checkedin_patients');
        $builder->where('uid', $_POST['uid']);
        $builder->where('aid', $_POST['appt_id']);
        $builder->where('is_checkedin', 1);
        $builder->where('delete_flag', 0);
        return $builder->countAllResults();
    }

    //==============***************=============//

    function sign_in()
    {
        $db = Database::connect();
        $data = $this->input->post();
        $builder = $db->table('users');
        $builder->select('id,full_name,email,latitude,longitude');
        $builder->where('email', $data['email']);
        $builder->where('delete_flag', 0);
        return $builder->get()->getRowArray();
    }

    //===============**************==============//

    function userPassword()
    {
        $data = $this->input->post();
        $db = Database::connect();
        $builder = $db->table('users');
        $builder->select('password');
        $builder->where('email', $data['email']);
        $builder->where('delete_flag', 0);
        $builder->get()->getRowArray()['password'];
    }

    //=============**************==============//

    function update_status()
    {
        $db = Database::connect();
        $data['status'] = $_POST['status'];
        $builder = $db->table('users');
        $builder->set($data);
        $builder->where('id', $_POST['id']);
        $builder->update();
        return true;
    }

    //=============**************==============//

    function view_profile()
    {
        $db = Database::connect();
        $builder = $db->table('users');
        $builder->set($data);
        $builder->where('id', $_POST['user_id']);
        $builder->where('delete_flag', 0);
        return $builder->get()->getRowArray();
    }

    //=============**************==============//

    function getAppointment()
    {

        $today = date('Y-m-d');
        $db = Database::connect();

        $builder = $db->table('appointments');
        $builder->where('date>=', $today);
        $builder->where('uid', $_POST['uid']);
        $builder->where('delete_flag', 0);
        return $builder->get()->getResultArray();
    }

    function getReplies()
    {
        $db = Database::connect();
        return $db->table('quick_replies')->get()->getResultArray();
    }

    function getWifi()
    {
        $db = Database::connect();
        return $db->table('wifi_info')->get()->getRowArray();
    }

    function get_messages()
    {
        $data = $this->input->post();
        $db = Database::connect();
        $builder = $db->table('chat_messages cm');
        $builder->join('chats c', 'c.id = cm.chat_id');
        $builder->join('users u', 'u.id = c.uid');
        $builder->where('u.id', $data['uid']);
        $builder->where('cm.is_sent', 1);
        return $builder->get()->getResultArray();
    }

    function getAds()
    {
        $db = Database::connect();

        $builder = $db->table('advertisement');
        $builder->select('id,title,image');
        $builder->where('is_active', 1);
        $builder->where('delete_flag', 0);
        $builder->orderBy('rand()');
        $builder->limit(1);
        return $builder->get()->getRowArray();
    }

    function forget_password()
    {
        $db = Database::connect();
        $pwd = $this->generate_password(6);


        $builder = $db->table('users');
        $builder->where('email', $_POST['email']);
        $builder->where('delete_flag', 0);
        $row = $builder->get()->getRowArray();
        return true;
        /*if (!empty($_POST['email'])) {
            $subject = "Kwanso App :: Password Reset";
            $message = "<html>
                            <head>
                                <style>
                                    table{
                                    border:1px solid #0bad11 ;
                                    width:80%;
                                    }
                                    p{  padding-left: 5%;}
                                    h3{ padding-left: 2%;}
                                    </style>
                            </head>
                            <body>
                                <table>
                                    <tr>
                                        <th style='background:#0bad11;color:white;font-size:2em;width:100%;'>
                                              Kwanso App
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                          <h3>Hello &nbsp; " . $row["full_name"] . " </h3>
                                           <p>Your new password for the app is  <b> $pwd.</p>
                                           <p>Please keep it on secured place. </p>                  
                                           <p>Thanks</p>
                                           <p>Kwanso</p>
                                        </td>
                                    </tr>
                                </table>
                            </body>
                      </html>";
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: Kwanso <no-reply@Kwanso.com>' . "\r\n";

            if (mail($_POST['email'], $subject, $message, $headers)) {
                $db->table('users')->set(['password' => password_hash($pwd, PASSWORD_BCRYPT)])->where('id', $row['id'])->update();
                return true;
            } else {
                return false;
            }
        }*/
    }

    function generate_password($length)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $res = substr(str_shuffle($chars), 0, $length);
        return $res;
    }

    //=============**************==============//

    function change_password()
    {
        $db = Database::connect();
        $old_password = $db->table('users')->select('password')->where('id', $_POST['user_id'])->get()->getRowArray();

        if ($old_password['password'] === $_POST['current_password']) {
            $db->table('users')->set(['password' => password_hash($_POST['password'], PASSWORD_BCRYPT)])->where('id', $_POST['user_id'])->update();
            return true;
        } else {
            return false;
        }
    }
}

?>
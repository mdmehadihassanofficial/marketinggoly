<?php

namespace App\Http\Controllers\frontend\config;

use App\Http\Controllers\Controller;
use App\Models\configSMTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;

class configuration extends Controller
{

    public function userId(){
        return Session::get( 'userSuccessLogined74264' );
    }
    
    public function configSmtpView(){
        $userId = $this->userId();
        $getSMTPConfig = configSMTP::where( 'uid', $userId )->orderBy('id', 'DESC')->first();
       return view('frontend.config.smtp', compact('getSMTPConfig'));
    }

    public function configSmtpStore(Request $request){
        $validator = Validator::make($request->all(), [
            'SMTPSecure' => 'required',
            'Host' => 'required',
            'Port' => 'required',
            'EmailUsername' => 'required',
            'EmailPasswoard' => 'required',
            'SetFrom' => 'required',
            'EmailName' => 'required',
            'ReplyToEmail' => 'required',
            'ReplyToEmailName' => 'required',
            'imapHostServer' => 'required',
            'imapPort' => 'required',
        ]);
        $userId = $this->userId();
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            $imapConnectionCheck = $this->imapConnectionCheck($request->imapHostServer, $request->imapPort, $request->EmailUsername, $request->EmailPasswoard);
            $SMTPConnectionCheck = $this->SMTPConnectionCheck($request->Host, $request->Port, $request->EmailUsername, $request->EmailPasswoard, $request->SMTPSecure, $request->SetFrom, $request->SetFrom);

            if($imapConnectionCheck == true){
                if($SMTPConnectionCheck == true){
                    $emailTemplate = configSMTP::where( 'uid', $userId )->first();
                    if (empty($emailTemplate )) {
                            try {
                                configSMTP::create( array(
                                    'uid'       => $userId,
                                    'SMTPSecure'     => $request->SMTPSecure,
                                    'Host'     => $request->Host,
                                    'Port'     => $request->Port,
                                    'EmailUsername'     => $request->EmailUsername,
                                    'EmailPasswoard'     => $request->EmailPasswoard,
                                    'SetFrom'     => $request->SetFrom,
                                    'EmailName'     => $request->EmailName,
                                    'ReplyToEmail'     => $request->ReplyToEmail,
                                    'ReplyToEmailName'     => $request->ReplyToEmailName,
                                    'imapHostServer'     => $request->imapHostServer,
                                    'imapPort'     => $request->imapPort,
                                    //'imapInboxFrom'     => $request->imapInboxFrom,
                                    'imapInboxFrom'     => 'INBOX',
                                ) );
                                return response()->json( [ 'success' => 'Your SMTP Data Successfully Saved' ] );
                            } catch ( Exception $e ) {
                                return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
                            }
                    }else{
                        try {
                            DB::table('config_s_m_t_p_s')
                            ->where('uid', $userId)
                            ->update([
                            'SMTPSecure'     => $request->SMTPSecure,
                            'Host'     => $request->Host,
                            'Port'     => $request->Port,
                            'EmailUsername'     => $request->EmailUsername,
                            'EmailPasswoard'     => $request->EmailPasswoard,
                            'SetFrom'     => $request->SetFrom,
                            'EmailName'     => $request->EmailName,
                            'ReplyToEmail'     => $request->ReplyToEmail,
                            'ReplyToEmailName'     => $request->ReplyToEmailName,
                            'imapHostServer'     => $request->imapHostServer,
                            'imapPort'     => $request->imapPort,
                            //'imapInboxFrom'     => $request->imapInboxFrom,
                            'imapInboxFrom'     => 'INBOX',
                        ]);
                                return response()->json( [ 'success' => 'Your SMTP Data Successfully Updated' ] );
                        } catch ( Exception $e ) {
                                return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
                        }
                    }
                }else{
                    return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again. Your SMTP Connection is not working'] );
                }
            }else{
                return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again. Your IMAP Connection is not working'] );
            }

        }
        return response()->json( [ 'success' => 'Your Campaign Added Successfully' ] );
    }

    public function imapConnectionCheck($hostname, $imapPort, $username, $password){
        // Try to connect
        $serverDetails = '{'.$hostname.':'.$imapPort.'/imap/ssl}';
       $imap = @imap_open($serverDetails, $username, $password);

        // Check connection
        if ($imap) {
            imap_close($imap);
            return true;
        } else {
            return false;
        }
    }
                //Imap List Here Like "Inbox, Sent, Drafts, Trash"
            //$hostname = '{'.$imapHostServer.':'.$imapPort.'/imap/ssl}'.$imapInboxFrom;
            // $serverDetails = '{mail.goly.link:993/imap/ssl}';
            //$imap = imap_list(imap_open($serverDetails, $username, $password), $serverDetails , '*');

    public function SMTPConnectionCheck(
        $host,
        $port,
        $username,
        $password,
        $encryption,
        $from,
        $to,
        $subject = 'SMTP Test',
        $body = 'This is a test email to verify the SMTP connection.'
    ) {
        $mail = new PHPMailer(true);
        $appName = env('APP_NAME');
    
        try {
            // SMTP settings
            $mail->isSMTP();
            $mail->Host       = $host;
            $mail->SMTPAuth   = true;
            $mail->Username   = $username;
            $mail->Password   = $password;
            $mail->SMTPSecure = $encryption === 'tls' ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = $port;
    
            // Email settings
            $mail->setFrom($from, $appName.' SMTP Test Email');
            $mail->addAddress($to); // Recipient
            $mail->Subject = $subject;
            $mail->Body    = $body;
    
            // Attempt to send email
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}
<?php

namespace App\Http\Controllers;

use App\Mail\email_confirm_message;
use App\Mail\email_read_message;
use App\Mail\email_message_readed;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Main extends Controller
{
    //==================================================
    public function index(){
        return view('message_form');
    }

     //==================================================
    public function init(Request $request){
        if(!$request->isMethod('post')){
            return redirect()->route('main_index');
        }

        // validation
        $request->validate(
            [
                'text_from' => ['required','email', 'max:50'],
                'text_to' => 'required|email|max:50',
                'text_message' => 'required|max:250',
            ],
            [
                'text_from.required' => 'From is required',
                'text_from.email' => 'Frm must be a valid email',
                'text_from.max' => 'From must have less than 50 chars',
                'text_to.email' => 'Frm must be a valid email',
                'text_to.max' => 'From must have less than 50 chars',
                'text_message.required' => 'Mesage is required',
                'text_message.max' => 'From must have less than 250 chars',

            ]
            );

            // CREATE HASH CODE (PURL CODE)
            $purl_code = Str::random(32);


            $message = new Message();

            $message->send_from = $request->text_from;
            $message->sendo_to = $request->text_to;
            $message->message = $request->text_message;
            $message->purl_confirmation = $purl_code;
            $message->save();

            // send email to comfirm message
            Mail::to($request->text_from)->send(new email_confirm_message($purl_code)); // email_confirm_message() está vindo do app\Mail\...

            // update da bd com da data e hora que o email de confirmação foi enviado
            $message = Message::where('purl_confirmation', $purl_code)->first();
            $message->purl_confirmation_sent = now(); // esse metodo now() vai salvar a data q esse atribuito for estanciado
            $message->save(); // save() serve pra fazer a atualizacao dos metodos e atribuitos


            // apresentar a view com a indicacao que o email de confirmacao foi enviado
                $data = [
                    'email_address' => $request->text_from
                ];

                return view('email_confirmation_sent', $data);
    }

     //==================================================
    public function confirm($purl){

        //check if purl exists
        if(empty($purl)){
            return redirect()->route('main_index');
        }

        // check if purl exists in db
        $message = Message::where('purl_confirmation', $purl)->first();

        // check is there is a message
        if($message === null){

            // apresentar uma view indicando que houve um erro.
            // TODO - fazer a view
            echo 'nao existeaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
            return;
        }


        // get the recipient email address
        $email_to = $message->sendo_to;


        // remove purl_confirmation and creates purl_read // ele ja vou utilizado pra confirmar q era ele msm. agora ta sendo removido
        $purl_code = Str::random(32);
        $message->purl_confirmation = null;
        $message->purl_read = $purl_code;
        $message->purl_read_sent = now(); // salva a data e hora atual
        $message->save();

        // send email to the recipient
        Mail::to($email_to)->send(new email_read_message($purl_code));


        echo 'Mensagem envaida';
        // xptOkVtM71AmShdzNegUL8NltLH2K4eV

    }
     //==================================================
    public function read($purl){

        //check if purl exists
        if (empty($purl)) {
            return redirect()->route('main_index');
        }

        // check if purl exists in db
        $message = Message::where('purl_read', $purl)->first();

        // check is there is a message
        if ($message === null) {

            // apresentar uma view indicando que houve um erro.
            // TODO - fazer a view
            echo 'nao existeeeeeeeeeeeeee';
            return;
        }

        // remove purl_read and store message_readed
        $message_readed = now();
        $email_recipient = $message->send_to;
        $email_from = $message->send_from;

        $message->purl_read = null;
        $message->message_readed = $message_readed;
        $message->save();

        // send email para o emitter confirming that the message was readed
        Mail::to($email_from)->send(new email_message_readed($email_recipient ,$message_readed));


        // display the one time message
        echo $message->message;
    }
}

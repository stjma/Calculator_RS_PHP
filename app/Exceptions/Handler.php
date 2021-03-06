<?php

namespace App\Exceptions;

use App\Mail\ErrorMail;
use Mail;



use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;


use Illuminate\Support\Facades\Session;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //Gestion de l'exception MethodNotAllowedHttpException
        if($exception instanceof MethodNotAllowedHttpException)
        {
            $this->Error($exception,"MethodNotAllowedHttpException");

            return redirect()->back();
        }

        //Gestion de l'exception NotFoundHttpException
        if($exception instanceof NotFoundHttpException)
        {
            $this->Error($exception,"NotFoundHttpException");

            return redirect()->back();
        }

        $this->Error($exception,"Exception");

        return redirect()->back();

    }

    //Envoie des courriel lorsqu'il y a des erreurs
    private function Error($error, $title){
        $content = [
                'title'=> $title,
                'body'=> $error,
                'button' => 'Click Here'
            ];

            $receiverAddress = 'test@gmail.com';

            Mail::to($receiverAddress)->send(new ErrorMail($content));
    }
}

<?php

namespace App\Exceptions;
     
use Throwable;
use Illuminate\Auth\AuthenticationException;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Illuminate\Support\Facades\Mail;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;

use Symfony\Component\ErrorHandler\ErrorRenderer\HtmlErrorRenderer;
use Exception;
use App\Mail\ExceptionOccured; // Asegúrate de importar la clase del Mailable



class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Throwable $Throwable)
    {
        if ($this->shouldReport($Throwable)) {
            if (config('app.env') == 'demo') {
                $this->sendEmail($Throwable); // sends an email in demo server
            }
        }

        parent::report($Throwable);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $Throwable)
    {
        return parent::render($request, $Throwable);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }

    /**
     * Sends the exception email in demo server
     *
     * @param $exception
     */
    public function sendEmail(Throwable $e)
    {
        try {
            // Convertimos la excepción en un FlattenException
            $e = FlattenException::createFromThrowable($e);
    
            // Usamos HtmlErrorRenderer en lugar de SymfonyExceptionHandler
            $renderer = new HtmlErrorRenderer();
            $html = $renderer->render($e)->getAsString();
    
            // Obtener el correo desde la configuración
            $email = config('mail.username');
    
            // Enviar el correo si la configuración está definida
            if (!empty($email)) {
                Mail::to($email)->send(new ExceptionOccured($html));
            }
        } catch (Exception $ex) {
            dd($ex); // Manejo de errores en caso de fallo al enviar el correo
        }
    }
}

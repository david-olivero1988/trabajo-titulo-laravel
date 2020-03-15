<?php

/**
 * Debugger utility
 * Clean code and delete after development
 * ---------------------------------------
 * @author NomikOS <usuario3@gmail.com>
 *
 * @param  int  $var  variable to debug
 * @param  int  $exit flag to finish php process
 * @see    http://stackoverflow.com/a/19788805/333061
 * @return void
 */

use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Mail;

function d($var, $description = '', $exit = 0, $fileLog = 'debugger')
{
    // $mailit = false;

    // $debuggeremail = function ($text)
    // {
    //     Mail::raw($text, function ($m)
    //     {
    //         $environment = strtoupper(\App::environment());

    //         if ('PRODUCTION' == $environment)
    //         {
    //             $m->subject("DEBUGGER (env:PRODUCTION)");
    //             $m->to('igor.parra@agente.cl', 'MANIMAL');
    //         }
    //         else
    //         {
    //             $m->subject("DEBUGGER (env:testing)");
    //             $m->to('igor.parra@agente.cl', 'MANIMAL');
    //         }

    //         $m->from('contacto@econocargo.cl', 'Econocargo DESARROLLO');
    //     });
    // };

    // $ip = Request::header('ip') ? : 'NOIP';
    // $user_id = Request::header('user-id') ?: 'NOUSERID';
    // $ip = '-';
    // $user_id = '-';

    // if (isset($_SERVER['HTTP_USER_ID']) && $_SERVER['HTTP_USER_ID'] != 3)
    // {
    //     // return;
    // }

    //dd(DB::getQueryLog())
    //
    //
    //
    //
    // if (isset($_SERVER['SERVER_ADMIN']) && $_SERVER['SERVER_ADMIN'] != 'root@nomikos.org')
    // {
    //     // return;
    // }

    // if (isset($_SERVER['SSH_CLIENT']) && !strstr($_SERVER['SSH_CLIENT'], '190.20.97.178'))
    // {
    //     return;
    // }

    // [[03/09/2016 13:54:44]] OrderController.php:309 ||  Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36

    // if (isset($_SERVER['HTTP_USER_AGENT']) && !strstr($_SERVER['HTTP_USER_AGENT'], 'Chrome/46') && !strstr($_SERVER['HTTP_USER_AGENT'], 'Chrome/46') )
    // {
    //     return;
    // }

    if (1 == $fileLog)
    {
        // pavo
        $fileLog = 'debugger';
    }

    $applog_debugger = realpath(dirname(__FILE__)) . '/storage/logs/debugger.log';
    $applog = realpath(dirname(__FILE__)) . '/storage/logs/' . $fileLog . '.log';

    $time = date('d/m/Y H:i:s', time()) . ' ADN laravel';

    ob_start();

    $resWithException = '';

    // if ($var instanceof \Dingo\Api\Exception\InternalHttpException)
    // {
    //     $file0 = $var->getFile();
    //     $line = $var->getLine();
    //     $file = '(EXCEPTION (InternalHttpException) en ' . basename($file0) . ':' . $line . ' )';

    //     if (method_exists($var, 'getResponse'))
    //     {
    //         $resWithException = $e->getResponse();
    //     }

    //     $description = $resWithException;

    //     echo "[[ $time | $ip | $user_id ]] $file || $description ";

    //     $mailit = true;
    // }

    // if ($var instanceof \Dingo\Api\Exception\ResourceException)
    // {
    //     $file0 = $var->getFile();
    //     $line = $var->getLine();
    //     $file = '(EXCEPTION (ResourceException) en ' . basename($file0) . ':' . $line . ' )';

    //     if (method_exists($var, 'getErrors'))
    //     {
    //         $resWithException = $var->getErrors();
    //     }

    //     $description = $resWithException;

    //     echo "[[ $time | $ip | $user_id ]] $file || $description ";

    //     $mailit = true;
    // }
    // else if ($var instanceof NotFoundHttpException)
    // {
    //     $file0 = $var->getFile();
    //     $line = $var->getLine();
    //     $file = '(EXCEPTION (NotFoundHttpException) en ' . basename($file0) . ':' . $line . ' )';

    //     $description = $description ? "$description: " : 'Not found';

    //     echo "[[ $time | $ip | $user_id ]] $file || $description ";
    // }
    // else if ($var instanceof Exception)
    // {
    //     $file0 = $var->getFile();
    //     $line = $var->getLine();
    //     $file = '(EXCEPTION en ' . basename($file0) . ':' . $line . ' )';

    //     if (strstr($line, 'La disponibilidad para su servicio ya no existe en el horario previamente agendado'))
    //     {
    //         return;
    //     }

    //     if (strstr($line, 'No reasignar a este vehiculo ni es posible despachar manualmente'))
    //     {
    //         return;
    //     }        

    //     $description = $description ? "$description: " : '';

    //     echo "[[ $time | $ip | $user_id ]] $file || $description ";

    //     $mailit = true;
    // }
    // else
    // {
        $debug_backtrace = debug_backtrace()[0];
        $fh = fopen($debug_backtrace['file'], 'r');
        $file = basename($debug_backtrace['file']);
        $line = $debug_backtrace['line'];

        $description = $description ? "$description: " : '';

        echo "[[ $time ]] $file:$line => $description ";
    // }

    // echo "HTTP_USER_ID: {$_SERVER['HTTP_USER_ID']} +++++++++++++++++++++++\n";

    if ($var === true)
    {
        echo 'TRUE (boolean)';
    }
    elseif ($var === false)
    {
        echo 'FALSE (boolean)';
    }
    elseif ($var === null)
    {
        echo 'NULL (null)';
    }
    else if ($var === '')
    {
        echo '(empty string)';
    }
    else if ( ! isset($var))
    {
        echo '(no isset)';
    }
    else
    {
        if ($var instanceof Exception)
        {
            echo $var->getMessage();
        }
        else
        {
            print_r($var);

        }
    }

    $dataDump = ob_get_clean();

    // if ($mailit)
    // {
    //     $debuggeremail($dataDump);
    // }

    var_dump( $dataDump); // for phpnit

    if ($exit)
    {
        $dataDump .= "\n\nEXIT! stopping programa by debugger <-------------------\n\n\n\n";
    }

    // if ( ! file_exists($applog))
    // {
    //     fopen($applog, 'a+');
    //     chmod($applog, 0666);
    // }

    file_put_contents($applog, "$dataDump\n", FILE_APPEND);

    /**
     * papertrail
     */
    // $logger = new Logger('api-ltl');
    // ErrorHandler::register($logger);
    // $logger->pushHandler(new SyslogUdpHandler("logs2.papertrailapp.com", 34812, LOG_USER, Logger::INFO));
    // $logger->addInfo($dataDump);

    /**
     * Esta bien separar a distintos logs y ademas
     * poner todo en el log principal
     */
    if ($fileLog != 'debugger' && 'loop_for_services' != $fileLog)
    {
        file_put_contents($applog_debugger, "$dataDump\n", FILE_APPEND);
    }

    if ($exit)
    {
        exit;
    }

    return;
}

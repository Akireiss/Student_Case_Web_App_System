<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            // Customize the file path as per your folder structure
            return response()->view('components.404', [], 404);
        }

        if ($exception instanceof QueryException && $this->isUnknownDatabaseException($exception)) {
            // Redirect to a common error page for database connection issues
            return redirect()->route('database.restore')->with('error', 'Database have been corrupt');
        }

        return parent::render($request, $exception);
    }

    protected function isUnknownDatabaseException(QueryException $exception)
    {
        // The error code for an unknown database in MySQL is 1049
        return $exception->getCode() == 1049;
    }
}

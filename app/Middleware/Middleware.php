<?php

declare(strict_types=1);

namespace App\Middleware;

/**
 * Middleware — base class for request guards.
 *
 * A middleware runs BEFORE the controller action. It can allow the
 * request to continue (do nothing) or stop it (redirect / error).
 *
 * To create your own middleware:
 *   class AdminMiddleware extends Middleware
 *   {
 *       public function handle(): void
 *       {
 *           // check something, then redirect() or just return
 *       }
 *   }
 */
abstract class Middleware
{
    /**
     * Run the guard. Return normally to allow the request to continue.
     */
    abstract public function handle(): void;
}

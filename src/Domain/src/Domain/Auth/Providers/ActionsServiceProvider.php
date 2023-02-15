<?php
declare(strict_types=1);

namespace Domain\src\Domain\Auth\Providers;

use Domain\src\Domain\Auth\Providers\Contracts\RegisterNewUserContract;
use Illuminate\Support\ServiceProvider;
use vendor\src\Domain\Auth\Actions\RegisterNewUserAction;

class ActionsServiceProvider extends ServiceProvider
{

public array $bindings = [
  RegisterNewUserContract::class=> RegisterNewUserAction::class
];
}

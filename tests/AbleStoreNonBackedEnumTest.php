<?php

namespace Spatie\Activitylog\Test;

use Spatie\Activitylog\Test\Enum\NonBackedEnum;
use Spatie\Activitylog\Test\Models\Activity;
use Spatie\Activitylog\Test\Models\User;

afterEach(fn() => Activity::query()->latest()->first()->delete());

it('can store non backed only a property', function () {
    $description = 'ROLE LOG';

    activity()
        ->performedOn(User::first())
        ->withProperty('role', NonBackedEnum::User)->log($description);

    $latestActivity = Activity::query()->latest()->first();

    expect($latestActivity->description)->toEqual($description)
        ->and($latestActivity->properties['role'])->toEqual('User');
});

it('can store non backed with properties', function () {
    $description = 'ROLE LOG';

    activity()
        ->performedOn(User::first())
        ->withProperties(['role' => NonBackedEnum::User])->log($description);

    $latestActivity = Activity::query()->latest()->first();

    expect($latestActivity->description)->toEqual($description)
        ->and($latestActivity->properties['role'])->toEqual('User');
});

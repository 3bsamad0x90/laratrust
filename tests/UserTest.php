<?php

use Laratrust\Contracts\LaratrustUserInterface;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Cache\ArrayStore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;
use Laratrust\Permission;
use Laratrust\Role;
use Mockery as m;

abstract class UserTest extends PHPUnit_Framework_TestCase
{
    private $facadeMocks = array();

    public function setUp()
    {
        parent::setUp();

        $app = m::mock('app')->shouldReceive('instance')->getMock();

        $this->facadeMocks['config'] = m::mock('config');
        $this->facadeMocks['cache'] = m::mock('cache');

        Config::setFacadeApplication($app);
        Config::swap($this->facadeMocks['config']);

        Cache::setFacadeApplication($app);
        Cache::swap($this->facadeMocks['cache']);
    }

    public function tearDown()
    {
        m::close();
    }

    protected function mockPermission($permName, $group_id = null)
    {
        $permMock = m::mock('Laratrust\Permission');
        $permMock->name = $permName;
        $permMock->display_name = ucwords(str_replace('_', ' ', $permName));
        $permMock->id = 1;

        $pivot = new stdClass();
        $pivot->group_id = $group_id;
        $permMock->pivot = $pivot;

        return $permMock;
    }

    protected function mockRole($roleName, $group_id = null)
    {
        $roleMock = m::mock('Laratrust\Role');
        $roleMock->name = $roleName;
        $roleMock->perms = [];
        $roleMock->permissions = [];
        $roleMock->id = 1;

        $pivot = new stdClass();
        $pivot->group_id = $group_id;
        $roleMock->pivot = $pivot;

        return $roleMock;
    }

    protected function mockGroup($groupName)
    {
        $groupMock = m::mock('Laratrust\Group');
        $groupMock->name = $groupName;
        $groupMock->id = 1;

        return $groupMock;
    }
}
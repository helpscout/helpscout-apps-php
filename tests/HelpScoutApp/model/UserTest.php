<?php
namespace HelpScoutApp\model;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testRoleAllowsStrings()
    {
        $user = new User((object) array(
            'role' => 'user',
        ));

        $this->assertSame('user', $user->getRole());
    }

    /**
     * @dataProvider isOwnerOrAdminProvider
     */
    public function testIsOwnerOrAdmin($role, $expectedResult)
    {
        $user = new User((object) array(
            'role' => $role,
        ));

        $this->assertSame($expectedResult, $user->isOwnerOrAdmin());
    }

    public function isOwnerOrAdminProvider()
    {
        return array(
            array('user', false),
            array('admin', true),
            array('owner', true),
        );
    }

    /**
     * @dataProvider isOwnerProvider
     */
    public function testIsOwner($role, $expectedResult)
    {
        $user = new User((object) array(
            'role' => $role,
        ));

        $this->assertSame($expectedResult, $user->isOwner());
    }

    public function isOwnerProvider()
    {
        return array(
            array('user', false),
            array('admin', false),
            array('owner', true),
        );
    }

    /**
     * @dataProvider isAdminProvider
     */
    public function testIsAdmin($role, $expectedResult)
    {
        $user = new User((object) array(
            'role' => $role,
        ));

        $this->assertSame($expectedResult, $user->isAdmin());
    }

    public function isAdminProvider()
    {
        return array(
            array('user', false),
            array('admin', true),
            array('owner', false),
        );
    }
}

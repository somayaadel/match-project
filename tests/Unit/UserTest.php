<?php


use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $application_key = "$2y$10$8IAbO4GqcjwWfHncXHmGVu8SvZm.6HBdEuPG38VcWbMB.csTO1lQa" ; 
    public function testRequiredFieldsForRegistration()
    {
        $response = $this->withHeaders([
            'application_key' => $this->application_key 
        ])->json('POST', '/user', ['name' => 'Sally']);
    }

}

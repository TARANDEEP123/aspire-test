<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        // $userData = [
        //     'name' => 'Test',
        //     'email' => 'test1user@gmail.com',
        //     'password' => '123456',
        //     'address'  => 'Address'
        // ];
        // $response = $this->post('/signUp', $userData);

        // if ($response->assertStatus(200)) {
            $userData = [
            'email' => 'taran@gmail.com',
            'password' => 'password'
        ];
            $response = $this->post('/api/login', $userData);
            if ($response->assertStatus(200)) {
                $userToken = 'Bearer '.$response['response']['token'];
                $loanType =  $this->get('/api/showLoanTypes',['Authorization'=>$userToken]);
                if ($loanType->assertStatus(200)) {
                    if (!empty($loanType['response'])) {
                        $applyLoan = $this->get('/api/applyForLoan/'.$loanType['response'][0]['id'], ['Authorization'=>$userToken]);
                        if($applyLoan->assertStatus(200)) {
                            $loanId = $applyLoan['response']['loanId'];
                            $adminLogin = $this->post('/api/login',['email' => 'admin@aspire.com','password' => 'password']);
                            if($adminLogin->assertStatus(200)) {
                                $adminToken = 'Bearer ' . $adminLogin['response']['token'];
                                $rejectLoan = $this->get('/api/rejectLoan/'.$loanId, ['Authorization'=>$adminToken]);
                                $rejectLoan->assertStatus(200);

                            }
                        }
                    }
                }
            }
        }
    }
//}

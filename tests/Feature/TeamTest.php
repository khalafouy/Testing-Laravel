<?php

namespace Tests\Feature;

use App\Team;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use DatabaseTransactions;
    /** @test */
    function it_check_team_name()
    {
        $team = new Team(['name'=>'Tech']);
        $this->assertEquals($team->name ,'Tech');
    }
    /** @test */
    function a_team_can_add_user()
    {

        $team = factory(Team::class)->create(['size'=>5]);
        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $team->add($userOne);
        $team->add($userTwo);


        $this->assertEquals(2,$team->count());

    }

    /** @test */
    function a_team_can_add_multiple_users_once()
    {

        User::query()->delete();
        $team = factory(Team::class)->create(['size'=>5]);
        $users = factory(User::class,6)->create();
        $team->add($users);
        $this->assertEquals(6,$team->count());

    }


    /** @test */
    function a_team_has_amax_number()
    {


        $team = factory(Team::class)->create(['id'=>1,'size'=>2]);
        $userOne = factory(User::class)->create(['name'=>'1','team_id'=>1]);
        $userTwo = factory(User::class)->create(['name'=>'2','team_id'=>1]);

        $team->add($userOne);
        $team->add($userTwo);


        $this->assertEquals(2,$team->count());



//        $userThree = factory(User::class)->create();
//        $this->expectException(\Exception::class);
//        $team->add($userThree);

    }

    /** @test a_team_can_remove_member*/
        function a_team_can_remove_member()
        {
            // given create team  , then add 2 members then delete one  so the count will be on a
            $team = factory(Team::class)->create(['id'=>1,'size'=>5]);
            $userOne = factory(User::class)->create(['team_id'=>1]);
            $userTwo = factory(User::class)->create(['team_id'=>1]);
            $userThree = factory(User::class)->create(['id'=>3,'team_id'=>1]);
            // when

            $team->add($userOne);
            $team->add($userTwo);
            $team->add($userThree);
            $team->remove($userThree);
            // then
            $this->assertEquals(2,$team->count());
        }


    /** @test a_team_can_remove_all_members*/
    function a_team_can_remove_all_members()
    {
        // given create team  , then add 2 members then delete one  so the count will be on a
        $team = factory(Team::class)->create(['id'=>1,'size'=>5]);
        $users = factory(User::class)->create(['team_id'=>1]);
        // when

        $team->add($users);
        $team->remove($users);
        // then
        $this->assertEquals(1,$team->count());
    }
}

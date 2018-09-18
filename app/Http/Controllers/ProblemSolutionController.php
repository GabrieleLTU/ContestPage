<?php
/**
 * Created by PhpStorm.
 * User: Gabriele
 * Date: 2018-09-11
 * Time: 13:04
 */

namespace App\Http\Controllers;


class ProblemSolutionController extends Controller
{
    private $problem;
    private $user;

    public function __construct(Problem $problem, User $user)
    {
        $this->problem = $problem;
        $this->user = $user;
    }

    //public function
}
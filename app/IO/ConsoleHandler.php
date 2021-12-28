<?php

namespace App\IO;

use App\Traits\RoverHelper;

class ConsoleHandler
{
    use RoverHelper;

    const OUTPUT_TYPE_DEFAULT='default';
    const OUTPUT_TYPE_ERROR='error';
    const OUTPUT_TYPE_SUCCESS='success';
    /**
     * @var int
     */
    private $step = 0;

    /**
     * @var array
     */
    private $info = [];

    /**
     * @var array
     */
    private $questions = [
        0 => "Would You Please Type The Upper-right Coordinates Of The Plateau (For Example \"5 5\")?",
        1 => "Would You Please Type The Rover\'s Current Position And Direction (For Example \"1 2 N\")?",
        2 => "Would You Please Type Series Of Instructions For Exploring The Plateau (For Example \"LMLMLMLMM\")?",
        3 => "Would You Want To Add Another Rover Current Position And Direction (y => yes , n => no (Print Result!))?",
        4 => "You can type \"q | Q\" for Quit and \"s | S\" for start again:",
    ];

    /**
     * @var array
     */
    protected $rovers = [];
    /**
     * @var int
     */
    protected $current_rover_index = 0;

    /**
     * @var
     */
    protected $plateau;

    /**
     * ConsoleQuestion constructor.
     */
    public function __construct()
    {
        $this->info[] = 'Hi,';
        $this->info[] = 'I am here to solve "The Mars Rover" problem for you!';
        $this->info[] = 'For Quit, You can type "q | Q".';
        $this->info[] = 'For Start Again, You Can type "s | S".';
    }


    /**
     * @return $this
     */
    public function run()
    {
        $this->printMessage($this->info);
        $this->printMessage("");
        $this->stepRun();
        return $this;
    }


    /**
     * @return ConsoleHandler|mixed
     */
    private function stepRun()
    {
        try {
            $this->printMessage($this->questions[$this->step],self::OUTPUT_TYPE_DEFAULT," ");
            $input = $this->readline();
            switch ($input) {
                case "s" | "S":
                    $this->plateau = NULL;
                    $this->rovers = [];
                    $this->current_rover_index = 0;
                    $this->step = 0;
                    return $this->run();
                    break;
                case "q" | "Q":
                    exit();
                    break;
                default:
                    $this->doTheTask($input);
                    break;
            }
        } catch (\Exception $e) {
            $this->printMessage("I'm Sorry! We Have A Problem!",self::OUTPUT_TYPE_ERROR);
            $this->printMessage($e->getMessage(),self::OUTPUT_TYPE_ERROR);
        }
        return $this->stepRun();
    }

    /**
     * @param $message
     * @param $type
     * @param $seperator
     * @return $this
     */
    private function printMessage($message,$type='default',$seperator="\r\n")
    {
        if (is_array($message)) {
            $message = implode("\r\n", $message);
        }
        $message=$message . $seperator;
        switch ($type){
            case 'success':
                echo "\033[32m".$message;
                break;
            case 'error':
                echo "\033[31m".$message;
                break;
            default;
                echo "\033[39m".$message;
                break;
        }
        return $this;
    }

    /**
     * @param $input
     * @return $this
     */
    public function doTheTask($input)
    {
        switch ($this->step) {
            case 0:
                $inputArray = $this->getInputAsArray($input);
                if (count($inputArray) == 2 && !empty($inputArray[0]) && !empty($inputArray[1])
                    && is_numeric($inputArray[0]) && is_numeric($inputArray[1])) {
                    $this->plateau = $this->createPlateau((int)$inputArray[0], (int)$inputArray[1]);
                    $this->step++;
                } else {
                    $this->printMessage("Input Is Wrong!",self::OUTPUT_TYPE_ERROR);
                }
                break;
            case 1:
                $inputArray = $this->getInputAsArray($input);
                if (count($inputArray) == 3 && !empty($inputArray[0]) && !empty($inputArray[1]) && !empty($inputArray[2])
                    && is_numeric($inputArray[0]) && is_numeric($inputArray[1]) && is_string($inputArray[2])) {
                    $this->rovers[$this->current_rover_index] = $this->createRover((int)$inputArray[0], (int)$inputArray[1], $inputArray[2],$this->plateau);
                    $this->step++;
                } else {
                    $this->printMessage("Input Is Wrong!",self::OUTPUT_TYPE_ERROR);
                }
                break;
            case 2:
                $inputArray = $this->getInputAsArray($input);
                if (count($inputArray) == 1 && !empty($inputArray[0]) &&  is_string($inputArray[0])) {
                    $this->runRoverCommand($this->rovers[$this->current_rover_index], $inputArray[0]);
                    $this->step++;
                } else {
                    $this->printMessage("Input Is Wrong!",self::OUTPUT_TYPE_ERROR);
                }
                break;
            case 3:
                $input = strtolower($input);
                if ($input == 'y' || $input == 'yes') {
                    $this->current_rover_index++;
                    $this->step = 1;
                } elseif ($input == 'n' || $input == 'no') {
                    $this->printMessage("I Solved This Problem And The Result IS:",self::OUTPUT_TYPE_SUCCESS,"\r\n\r\n");
                    foreach ($this->rovers as $rover) {
                        $result = (string)$rover;
                        $this->printMessage($result);
                    }
                    $this->printMessage("");
                    $this->step++;
                } else {
                    $this->printMessage("Input Is Wrong!",self::OUTPUT_TYPE_ERROR);
                }
                break;
                break;
        }
        return $this;
    }


    /**
     * @return string
     */
    private function readline()
    {
        return trim(fgets(STDIN));
    }


    /**
     * @param $input
     * @return array
     */
    private function getInputAsArray($input)
    {
        return explode(" ", $input);
    }

}
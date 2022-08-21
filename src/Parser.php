<?php

namespace App;

class Parser
{
    private $max_monolog;
    private $speeches;
    private $silences;
    private $totalDuration;
    private $totalSilince;

	public function __construct()
	{
        $this->max_monolog = 0;
        $this->speeches = [];
        $this->silences = [];
        $this->totalDuration = 0;
        $this->totalSilince = 0;
	}



    /**
     * Process file input.
     * 
     * @param string $name
     * 
     * @return null
     */
	public function processInput($name)
	{
        $speechEnd = $speechStart = $silenceStart = $silenceEnd = 0;

        $handle = fopen("./storage/{$name}", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                // This is not the optimal way of removing the hashes, 
                // ideally with will be with some regex...I guess.
                $line = str_replace([
                    '[', ']', 
                    '0x7fbfbbc076a0', 
                    '0x7fa7edd0c160', 
                    'silencedetect', '@'
                ], '', $line);

                $line = explode(' ', $line);
                $line = array_filter($line);
                $line = array_values($line);

                if(strpos($line[0], 'silence_end') !== false){
                    $speechStart = doubleval($line[1]);
                    $silenceEnd = doubleval($line[1]);
                    
                    $this->totalDuration = doubleval($line[1]);
                }
                
                if(strpos($line[0], 'silence_start') !== false){
                    $speechEnd = doubleval($line[1]);
                    $silenceStart = doubleval($line[1]);
                }

                $this->longestMonolog($speechStart, $speechEnd);
                
                $this->pushToArray([$speechStart, $speechEnd], 'speeches');
                $this->pushToArray([$silenceEnd, $silenceStart], 'silences');
            }
        }
	}

    /**
     * Push into the given array.
     * 
     * @param $elements
     * 
     * @return null
     */
	public function pushToArray($elements, $array)
	{
        array_push($this->$array, $elements);
    }

    /**
     * Gets the longest monolog.
     * 
     * @param string $start
     * @param string $end
     * 
     * @return null
     */
    private function longestMonolog($start, $end)
    {
        $duration = $end - $start;
        $this->max_monolog = $duration > $this->max_monolog ? $duration : $this->max_monolog;
    }

    /**
     * Return class property if exists.
     * 
     * @param string $property
     * 
     * @return mixed $property
     */
    public function get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
          }
    }
}
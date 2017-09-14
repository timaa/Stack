<?php
class BracketParser
{
    private $stack = [];
    private $revBracket = [']' => '[', '}' => '{', ')' =>'('];
    private $openBrackets = ["(","{", "["];
    private $closeBrackets = [")", "}", "]"];
    private $indexOfNotBalancedBracked = 0;

    public function parse(string $expression)
    {
        for($i = 0; $i < strlen($expression); $i++) {
            if (count($this->stack) != 0 && $this->isReverseElementForTop($expression[$i])) {
                $this->pop();
            } else {
                if (in_array($this->topElem(), $this->openBrackets) && in_array($expression[$i], $this->closeBrackets)) {
                    $this->indexOfNotBalancedBracked = $i - 1;
                }
                $this->push($expression[$i]);
            }
        }

        if(empty($this->stack)) {
            echo -1;
        }
        else
            echo $this->indexOfNotBalancedBracked;
        var_dump($this->stack);
    }

    public function isReverseElementForTop($elem): bool
    {
        return array_key_exists($elem, $this->revBracket) && $this->topElem() == $this->revBracket[$elem];
    }

    public function pop()
    {
        array_pop($this->stack);
    }

    public function push($elem)
    {
        array_push($this->stack, $elem);
    }

    public function topElem(): string
    {
        return count($this->stack) != 0 ? $this->stack[count($this->stack) - 1] : "";
    }
}



$parser = new BracketParser();

$parser->parse("{}[]()");

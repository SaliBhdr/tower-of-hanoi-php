# Tower Of Hanoi
A simple PHP script to solve tower of hanoi alogorithm with viasual moves

![Tower Of Hanoi Salar Bahador](https://www.dropbox.com/s/ydhzvoz3kugwyjx/index.png?raw=1)

## Introduction

Tower of Hanoi game is a puzzle invented by French mathematician Édouard Lucas in 1883.

**History of Tower of Hanoi**

There is a story about an ancient temple in India (Some say it’s in Vietnam – hence the name Hanoi) 
has a large room with three towers surrounded by 64 golden disks (1.844674407371E+19 days).

These disks are continuously moved by priests in the temple. According to a prophecy, 
when the last move of the puzzle is completed the world will end.
These priests acting on the prophecy, follow the immutable rule by Lord Brahma 
of moving these disk one at a time.Hence this puzzle is often called Tower of Brahma puzzle.
Tower of Hanoi is one of the classic problems to look at if you want to learn **recursion**.
It is good to understand how **recursive** solutions are arrived at and how parameters for this recursion are implemented.

**What is the game of Tower of Hanoi?**

Tower of Hanoi consists of three pegs or towers with n disks placed one over the other.

The objective of the puzzle is to move the stack to another peg following these simple rules.

1) Only one disk can be moved at a time.
2) No disk can be placed on top of the smaller disk.

# Usage

Just clone or download the script. Put it into your local repository. Open index.php in address bar like so:
```
http://localhost/tower-of-hanoi/index.php
```

A form will appear.The form contains one input for entering number of disks and 3 options for showing the result.

Here is the simple algorithm of tower of hanoi
```
function towerOfHanoi($diskCount, $a = 'A', $b = 'B', $c = 'C')
{
    if ($diskCount == 1) {
        echo "move {$a} to {$c}". "<br>";
    } else {
        towerOfHanoi($diskCount - 1, $a, $c, $b);
        towerOfHanoi(1, $a, $b, $c);
        towerOfHanoi($diskCount - 1, $b, $a, $c);
    }
}

```

## Options
You can output the result with these three options:

1) **Full draw** : visual drawing of solving the algorithm

![Hamoi Full Draw](https://www.dropbox.com/s/hts53ebolit6knt/full_draw.png?raw=1)

2) **Simple solve** : just outputs the steps

![Hamoi Simple Solve](https://www.dropbox.com/s/qhxiqrthf3qw6ap/simple_solve.png?raw=1)

3) **Only moves** : outputs the minimum number of moves for solving the algorithm based on disks

![Hamoi Calculate Moves](https://www.dropbox.com/s/pdt9toycwzm6g54/only_moves.png?raw=1)

## Further readings

For more info about tower of hanoi check out [this blog][df1]

## License

This project is released under the MIT License.

Built with ❤ for you.

**Free Software, Hell Yeah!**


   [df1]: https://www.hackerearth.com/blog/developers/tower-hanoi-recursion-game-algorithm-explained/
   
   
<?php

namespace app\models;

use yii\base\Model;

/**
 * class CalcModel
 *
 * @property int $result readonly
 * @property string $msg readonly
 */

class CalcForm extends Model
{
    /** @var int */
    public $start;

    /** @var int */
    public $end;

    /** @var int */
    protected $total = 0;

    /** @var string  */
    protected $message = '';

    /** @var array  */
    protected static $prices = [
        [
            'start' => 0,
            'end' => 2500,
            'price' => 1,
        ],
        [
            'start' => 2500,
            'end' => 3500,
            'price' => 3,
        ],
        [
            'start' => 3500,
            'end' => 5500,
            'price' => 5,
        ],
        [
            'start' => 5500,
            'end' => 7000,
            'price' => 10,
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start', 'end'], 'integer', 'min' => 0, 'max' => 7000],
        ];
    }

    /**
     * @return bool
     */
    public function calc()
    {
        if (!$this->validate()) {
            return false;
        }

        $result = 0;
        $finish = false;
        $prices = static::$prices;

        while (!$finish) {
            $c = current($prices);

            $a = null;
            if ($this->start > $c['start']) {
                if ($this->start < $c['end']) {
                    $a = $this->start;
                }
            } else {
                $a = $c['start'];
            }

            $b = null;
            if ($this->end < $c['end']) {
                if ($this->end > $c['start']) {
                    $b = $this->end;
                } else {
                    $finish = true;
                }
            } else {
                $b = $c['end'];
            }

            if ($a && $b && !$finish) {
                $r = ($b - $a) * $c['price'];
                $this->message .= '(' . $b . ' - ' . $a . ') * ' . $c['price'] . ' = ' . $r . "\n";
                $result += $r;
            }

            if (!next($prices)) {
                $finish = true;
            }

        }

        $this->total = $result;

        return true;
    }

    /**
     * @return int
     */
    public function getResult()
    {
        return $this->total;
    }

    /**
     * @return string
     */
    public function getMsg()
    {
        return $this->message;
    }
}
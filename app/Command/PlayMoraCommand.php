<?php

declare(strict_types=1);

namespace App\Command;

use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;

#[Command]
class PlayMoraCommand extends HyperfCommand
{
    public const GESTURES = [
        0 => '剪刀',
        1 => '石头',
        2 => '布',
    ];

    protected ?string $name = 'play:mora';

    public function configure()
    {
        parent::configure();
        $this->setDescription('剪刀石头布游戏');
    }

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $this->line("现在开始一个剪刀石头布游戏\n", 'info');

        $answer = $this->choice('请选择你要出的手势：', self::GESTURES, 0);
        $this->output->info(sprintf('你选择了：%s', $answer));

        $answer = array_flip(self::GESTURES)[$answer];

        $computer = random_int(0, 2);
        $this->output->info(sprintf("计算机选择出：%s", self::GESTURES[$computer]));

        $result = mora($answer, $computer);

        $result = match($result) {
            0 => "平局",
            1 => "玩家获胜",
            -1 => "玩家失败",
        };
        $this->output->caution(sprintf("本轮比赛结果：%s", $result));
    }
}

<?php

namespace App\Listeners;

use App\SpamWord;
use Illuminate\Support\Str;
use App\Events\MailCreated;
use App\AnalyzeMail as Analyze;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AnalyzeMail implements ShouldQueue
{

    private $rex = '<i class="text-muted">%w%</i>';

    /**
     * Handle the event.
     *
     * @param  MailCreated  $event
     * @return void
     */
    public function handle(MailCreated $event)
    {
        Analyze::create(array_merge(
            [ 'mail_id' => $event->mail->id ],
            $this->formatData($event->mail->body)
        ));
    }
    
    public function formatData($body)
    {
        $num_words = $this->getNumWord($body);
        $num_spam_words = 0;
        $pts = 0;

        foreach ($this->getWords() as $row) {
            $re = '/'.$row['word'].'/m';

            preg_match_all($re, $body, $matches, PREG_SET_ORDER, 0);
            $num_spam_words += count($matches);

            $pts += $row['pts'] * count($matches);
        }
        
        return [
            'pts' => $num_spam_words > 0 
                ? number_format($pts / $num_spam_words, 2)
                : 0,
            'format_body' => $this->getFormatBody($body),
            'num_words' => $num_words,
            'num_spam_words' => $num_spam_words
        ];
    }

    public function getNumWord($body)
    {
        preg_match_all("/\w+/m", $body, $matches, PREG_SET_ORDER, 0);
        return count($matches);
    }

    public function getFormatBody($body)
    {
        foreach (SpamWord::all() as $row) {
            $str = str_replace('%w%', $row['word'], $this->rex);

            $body = str_replace($row['word'], $str, $body);
        }

        return $body;
    }

    public function getWords()
    {
        $words = [];

        foreach (SpamWord::all() as $word) {
            $row = $word->toArray();
            $w = Str::slug($row['word']);

            $str = strtoupper($w);
            $str .= '|'.strtolower($w);
            $str .= '|'.ucfirst($w);
            
            $row['word'] = "($str)";
            $words[] = $row;
        }

        return $words;
    }
}

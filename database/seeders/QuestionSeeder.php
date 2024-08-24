<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $commonArray = [
            // Common symptoms
            [
                'type' => "common",
                'question' => "Do you feeling a Persistent Low Mood and Sadness",
                'description' => "Do you experience a persistent feeling of sadness and low mood that affects daily life", 'group_id' => 0
            ],
            [
                'type' => "common",
                'question' => "Do you experience Loss of Interest in Activities",
                'description' => "Any situation where you have loss of interest in activities that were once enjoyable", 'group_id' => 0
            ],
            [
                'type' => "common",
                'question' => "Do you feel any Fatigue and Lack of Energy",
                'description' => "Feeling tired all the time and having a lack of energy", 'group_id' => 0
            ],
            [
                'type' => "common",
                'question' => "Do you experience Sleep Disturbance",
                'description' => "Problems with sleep, such as difficulty falling asleep or waking up early", 'group_id' => 0
            ],
            [
                'type' => "common",
                'question' => "Do you experience any Changes in Appetite",
                'description' => "Changes in appetite, whether an increase or decrease", 'group_id' => 0
            ],
            [
                'type' => "common",
                'question' => "Do you experience Difficulty Concentrating and Making Decisions",
                'description' => "Struggling with concentration and decision-making", 'group_id' => 0
            ],
            [
                'type' => "common",
                'question' => "Do you have any Thoughts of Death or Suicide",
                'description' => "Possible suicidal thoughts", 'group_id' => 0
            ],
        ];


        $generalDepressionArray = [
            // General symptoms
            [
                'type' => "general",
                'question' => "Do you experience any physical symptoms",
                'description' => "Includes physical signs like moving or speaking slowly, constipation, and unexplained aches and pains", 'group_id' => 1
            ],
            [
                'type' => "general",
                'question' => "Do you find yourself Socially withdrawing",
                'description' => "Includes avoiding social contact and neglect hobbies, leading to difficulties in home, work, or family life.", 'group_id' => 1
            ],
            [
                'type' => "general",
                'question' => "Does your experience seem severe or unpredictable",
                'description' => "It can range from mild to severe and can come on gradually, making it hard to notice initially.", 'group_id' => 1
            ],
            [
                'type' => "general",
                'question' => "Any noticeable psychological symptoms",
                'description' => "Feelings of guilt, hopelessness, low self-esteem, and irritability are more emphasized.", 'group_id' => 1
            ]
        ];

        $postnatalDepressionArray = [
            // postnatal symptoms
            [
                'type' => "postnatal",
                'question' => "Have you had a child in the past 1 year",
                'description' => "This can occurs after childbirth and can affect both mothers and fathers.", 'group_id' => 2
            ],
            [
                'type' => "postnatal",
                'question' => "Do you find it difficult to care for your Baby (if you have any)",
                'description' => "This often includes difficulty in caring for oneself and the baby, as well as frightening thoughts about harming the baby.", 'group_id' => 2
            ],
            [
                'type' => "postnatal",
                'question' => "Do you experience a lack of awareness",
                'description' => "Many people do not realize they have postnatal depression because it can develop gradually and is often confused with 'baby blues.'", 'group_id' => 2
            ],
            [
                'type' => "postnatal",
                'question' => "Anxiety and Panic Attacks",
                'description' => "Other mental health symptoms, such as anxiety and panic attacks, are common in postnatal depression.", 'group_id' => 2
            ]
        ];

        $psychoticDepressionArray = [
            // psychotic symptoms
            [
                'type' => "psychotic",
                'question' => "Do you experience Psychosis",
                'description' => "Such as delusions and hallucinations, where a person may lose touch with reality.", 'group_id' => 3
            ],
            [
                'type' => "psychotic",
                'question' => "Do you notice any Psychomotor Changes",
                'description' => "Includes psychomotor agitation (restlessness and inability to sit still) or psychomotor retardation (slowed movements and thoughts).", 'group_id' => 3
            ],
            [
                'type' => "psychotic",
                'question' => "Do you feel extreme Guilt and Worthlessness",
                'description' => "Delusions and hallucinations often reflect extreme feelings of guilt or worthlessness, which are less common in other types.", 'group_id' => 3
            ],
            [
                'type' => "psychotic",
                'question' => "Do you think you at a Risk of committing Suicide",
                'description' => "The risk of suicide is particularly high in psychotic depression due to the intense and distressing nature of the symptoms.", 'group_id' => 3
            ]
        ];

        foreach ($commonArray as $commons) {
            Question::updateOrCreate($commons);
        }

        foreach ($generalDepressionArray as $general) {
            Question::updateOrCreate($general);
        }

        foreach ($postnatalDepressionArray as $postnatal) {
            Question::updateOrCreate($postnatal);
        }

        foreach ($psychoticDepressionArray as $psychotic) {
            Question::updateOrCreate($psychotic);
        }
    }
}

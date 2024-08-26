<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::updateOrCreate(['group' => '-']);

        Group::updateOrCreate([
            'group' => 'General Depression',
            'description' => 'The symptoms of depression can be complex and vary widely between people. If you\'re depressed, you may feel sad, hopeless and lose interest in things you used to enjoy. The symptoms persist for weeks or months and are bad enough to interfere with your work, social life and family life. There are many other symptoms of depression and you\'re unlikely to have all of those listed on this page.',
            'solution' => 'Treatment for depression usually involves a combination of self-help, talking therapies and medicines. The treatment recommended will be based on the type of depression you have. Some recommendations include; Wait and see, Exercise, Talking therapies, Antidepressants, Combination therapy, Mental health teams, Cognitive Behavioral therapy (CBT), Interpersonal therapy (IPT), Behavioral activation, Individual problem-solving, Counselling, Behavioral couples therapy.',
            'link' => 'https://www.nhs.uk/mental-health/conditions/depression-in-adults/treatment/']);

        Group::updateOrCreate([
            'group' => 'Postnatal Depression',
            'description' => 'Postnatal depression is a type of depression that many parents experience after having a baby. It\'s a common problem, affecting more than 1 in every 10 women within a year of giving birth. It can also affect fathers and partners. It\'s important to get help as soon as possible if you think you might be depressed, as your symptoms could last for months or get worse and have a significant impact on you, your baby and your family. With the right support most people make a full recovery.',
            'solution' => 'Postnatal depression can be lonely, distressing and frightening, but support and effective treatments are available.These include: self-help – things you can try yourself include talking to your family and friends about your feelings and what they can do to help, making time for yourself to do things you enjoy, resting whenever you get the chance, getting as much sleep as you can at night, exercising regularly, and eating a healthy diet talking therapy – a GP may be able to recommend a self-help course or may refer you for a course of therapy, such as cognitive behavioral therapy (CBT) antidepressants – these may be recommended if your depression is more severe or other treatments have not helped; your doctor can prescribe a medicine that\'s safe to take while breastfeeding Local and national organizations, such as the Association for Post Natal Illness (APNI) and Pre and Postnatal Depression Advice and Support (PANDAS), can also be useful sources of help and advice.',
            'link' => 'https://www.nhs.uk/mental-health/conditions/post-natal-depression/overview/']);

        Group::updateOrCreate([
            'group' => 'Psychotic Depression',
            'description' => 'Some people who have severe depression may also experience hallucinations and delusional thinking, the symptoms of psychosis.Depression with psychosis is known as psychotic depression.',
            'solution' => 'Treatment for psychotic depression involves: Medicine – a combination of antipsychotics and antidepressants can help relieve the symptoms of psychosis talking therapies – the 1-to-1 talking therapy cognitive behavioral therapy (CBT) has proved effective in helping some people with severe depression, including those with psychosis. social support – support with social needs, such as education, employment or accommodation The person may need to stay in hospital for a short period of time while they\'re receiving treatment. Electroconvulsive therapy (ECT) may sometimes be recommended if the person has severe depression and other treatments, including antidepressants, have not worked. The mental health charity Mind has more information on ECT. Treatment is usually effective, but follow-up appointments so that the person can be closely monitored are usually required.',
            'link' => 'https://www.nhs.uk/mental-health/conditions/psychotic-depression/']);
    }
}

<?php
// Arrays of different environments
$environments = [
  "medieval village",
  "magical forest",
  "wizard’s tower",
  "haunted castle",
  "dwarven mine",
  "enchanted meadow",
  "skyship dock",
  "crystal cave",
  "goblin warcamp",
  "ruined temple"
];

// Associating specific actions with each environment
$specific_actions_by_environment = [
  "medieval village" => [
    "swapping a knight’s helmet with a bucket",
    "tying a villager’s shoelaces together",
    "placing a whoopee cushion under the mayor’s chair",
    "filling a barrel of ale with frogs"
  ],
  "magical forest" => [
    "getting tangled in a vine while trying to swing like a monkey",
    "trying to fish with a broken spear",
    "making friends with a talking tree who tells bad jokes",
    "climbing a tree and getting stuck, yelling for help"
  ],
  "wizard’s tower" => [
    "mixing potions that explode into clouds of glitter",
    "turning invisible but forgetting their feet are showing",
    "accidentally summoning a tiny but angry fire elemental",
    "dropping a scroll and summoning a flock of ravens"
  ],
  "haunted castle" => [
    "scaring villagers with a floating sheet and a candle",
    "moving objects in the castle without being seen",
    "pretending to be a ghost by howling in the hallways",
    "replacing all the skeletons’ bones with sticks"
  ],
  "dwarven mine" => [
    "stealing a miner’s pickaxe and using it as a toothpick",
    "rolling boulders down a mine shaft for fun",
    "tying dynamite fuses together to prank the dwarves",
    "eating precious gems thinking they are candy"
  ],
  "enchanted meadow" => [
    "befriending a group of squirrels and causing mayhem",
    "stealing flowers from a fairy circle",
    "chasing butterflies while giggling",
    "trying to ride a deer and falling off"
  ],
  "skyship dock" => [
    "untying ropes from a skyship to see it float away",
    "pretending to be the captain and giving bad orders",
    "climbing the rigging of a skyship and getting stuck",
    "filling a balloon with air and letting it fly around the dock"
  ],
  "crystal cave" => [
    "stealing crystals and trying to juggle them",
    "using a crystal to make funny reflections on the cave walls",
    "pretending to be a stalactite and scaring adventurers",
    "singing loudly to hear their voice echo"
  ],
  "goblin warcamp" => [
    "tripping other goblins during training exercises",
    "painting mustaches on goblin flags",
    "swapping weapons with rubber chickens",
    "setting fire to tents while laughing"
  ],
  "ruined temple" => [
    "pretending to be a statue to scare adventurers",
    "stealing an ancient artifact and wearing it as a hat",
    "climbing onto crumbling pillars and yelling for help",
    "drawing mustaches on sacred murals"
  ]
];

// Arrays for genders, races, and actions at the end of the prompt
$genders = ["male", "female"];
$races = ["elf", "dwarf", "human", "halfling", "half-orc", "tiefling"];
$end_actions = [
  "looks on unamused",
  "crosses their arms with a smirk",
  "sighs in frustration",
  "chuckles quietly",
  "raises an eyebrow",
  "shakes their head"
];

// Randomly select an environment
$random_environment = $environments[array_rand($environments)];

// Randomly select an action based on the chosen environment
$random_action = $specific_actions_by_environment[$random_environment][array_rand($specific_actions_by_environment[$random_environment])];

// Randomly select a gender, race, and end action
$random_gender = $genders[array_rand($genders)];
$random_race = $races[array_rand($races)];
$random_end_action = $end_actions[array_rand($end_actions)];

// Determine if the end tag should appear (e.g., 30% chance)
$include_end_tag = rand(1, 100) <= 30; // Set to desired percentage (30% chance in this example)

// Create the generalized prompt with or without the added character and action
$prompt_template = "A mischievous DND FANTASY TABLETOP GOBLIN in a {environment} setting, involved in a humorous or chaotic activity like {specific_action}, with bright, playful colors. The scene is illustrated in an EPIC WIDE WATERCOLOR ILLUSTRATION style, featuring detailed elements of the {environment}, and the goblin’s mischievous grin or expression taking center stage.";

if ($include_end_tag) {
  $prompt_template .= " A {random_gender} {random_race} {random_end_action}.";
}

// Replace placeholders with actual values
$prompt = str_replace(
  ['{environment}', '{specific_action}', '{random_gender}', '{random_race}', '{random_end_action}'],
  [$random_environment, $random_action, $random_gender, $random_race, $random_end_action],
  $prompt_template
);

// Output the final prompt
echo $prompt;

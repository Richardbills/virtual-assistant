import sys
import json
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.neighbors import KNeighborsClassifier
from sklearn.pipeline import make_pipeline
from sklearn.feature_extraction import text

# Expanded vocabulary categorized into labels
vocab = {
    'Negative Mood': [
        "unhappy", "sadness", "low mood", "feeling down", "feeling blue",
        "miserable", "hopeless", "helpless", "fed up", "depressed",
        "feeling crappy", "feeling like crap", "feeling like a failure",
        "feeling blah", "just don’t care anymore", "life sucks",
        "hate my life", "can’t deal with life", "so done with everything",
        "feeling out of it", "feel like giving up",
        "crying a lot", "tearful", "feeling alone", "feeling isolated"
    ],
    'Fatigue': [
        "tired all the time", "no energy", "exhausted", "worn out",
        "always tired", "feeling worn out"
    ],
    'Sleep Issues': [
        "trouble sleeping", "can't sleep", "waking up early",
        "oversleeping", "sleeping too much", "sleepy during the day"
    ],
    'Appetite and Weight Changes': [
        "appetite changes", "no appetite", "eating too much",
        "weight loss", "losing weight", "weight gain", "gaining weight"
    ],
    'Cognitive Difficulties': [
        "can't concentrate", "can't focus", "hard to decide",
        "making decisions is hard", "no motivation", "not interested in anything"
    ],
    'Guilt and Self-Worth': [
        "guilty feelings", "feeling guilty", "worthless", "useless",
        "good for nothing", "feeling like a failure"
    ],
    'Suicidal Thoughts': [
        "want to die", "thoughts of death", "thinking about suicide",
        "thinking about hurting myself", "self-harm", "cutting myself"
    ],
    'Colloquial Terms': [
        "feeling crappy", "feeling like crap", "feeling like a failure",
        "feeling blah", "just don’t care anymore", "life sucks",
        "hate my life", "can’t deal with life", "so done with everything",
        "feeling out of it", "feel like giving up"
    ]
}

# Convert the vocabulary into training samples and labels
samples = []
labels = []
for label, words in vocab.items():
    for word in words:
        samples.append(word)
        labels.append(label)

def classify_text(query):
    # Create the pipeline
    model = make_pipeline(
        CountVectorizer(stop_words='english'),
        KNeighborsClassifier(n_neighbors=1)
    )

    # Train the model
    model.fit(samples, labels)

    # Predict the class for the input query
    prediction = model.predict([query])[0]

    # Get related terms for the predicted label
    related_terms = vocab.get(prediction, [])

    return {
        "prediction": prediction,
        "related_terms": related_terms
    }

if __name__ == "__main__":
    # Get the input from the command line (from PHP)
    input_query = sys.argv[1]

    # Classify the input text
    result = classify_text(input_query)

    # Print the result as JSON
    print(json.dumps(result))

import os
import sys
import json
import pickle
import pandas as pd
import numpy as np

# # Activate the virtual environment
# activate_env = "<env_name>\\Scripts\\activate"
# os.system(activate_env)


# Load the trained model
pipe = pickle.load(open('pipe.pkl', 'rb'))

# Parse the input JSON data
input_json = sys.argv[1]
input_data = json.loads(input_json)

# Extract input features
batting_team = input_data['batting_team']
bowling_team = input_data['bowling_team']
city = input_data['city']
current_score = float(input_data['current_score'])

# Convert 'overs' to a numeric type (assuming it's a string)
overs = float(input_data['overs'])

# Calculate additional features
balls_left = int(120 - (overs * 6))
wickets_left = int(10 - int(input_data['wickets_left']))
crr = current_score / overs
# crr=4.9
# balls_left=60
# wickets_left=9
# Extract the missing columns from the input data
last_five = input_data['last_five']

# ... (other feature extraction)

# Prepare input data as a DataFrame
input_df = pd.DataFrame({
    'batting_team': [batting_team],
    'bowling_team': [bowling_team],
    'city': [city],
    'current_score': [current_score],
    'balls_left': [balls_left],
    'wickets_left': [wickets_left],  # Include wickets_left
    'crr': [crr],  # Include crr
    'last_five': [last_five],  # Include last_five
    # ... (other features)
})

# Make predictions
result = pipe.predict(input_df)

# Print the predicted score
print(int(result[0]))

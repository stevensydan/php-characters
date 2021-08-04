--[ Created by: Steven Pham (889423067) & Samantha Ibasitas (889328258) ]--


--[ Background ]--

This application was created for Dungeons and Dragons players. Users have the ability to login to our website to view other players and their characters as well as creating their own characters. When users create their own characters, they are able to input a character name, level, class, race, number of quests completed along with an avatar. Not only can our users create characters and view other users' characters, but they also have the ability to delete their existing characters. 


--[ Actor ]--
User


--[ Use Cases ]--

LOGGING IN (VIEW CHARACTERS) 
Users at homepage can click the "Log-In" button to be brought to a login page with two options; one of which can log in to an existing account with both userEmail and userPass already saved. The login requires both a userName and userPass to successfully enter the website. 

CREATING AN ACCOUNT
The second option on the log-in page is to register a new account. An account can be created if the userEmail is not already being used. The userPass does not have to be different from other existing userPass. This step notifies them by email of the account creation while also refreshing the log-in page.

CREATING A CHARACTER
The user has the ability to create a character once logged in/created an account, this is if userStatus is true. The user will be directed to the "Submit Character" page where they can input the charName, charLevel, and other character fields and upload charArt to go with their character creation. 

DELETING A CHARACTER
The user has the ability to delete an already created character once logged in/created an account. The user will be able to go into their account details which will show them their created characters with the option to delete them. 


--[ Fulfilled Requirements ]--

File uploads
Database access
Access control 
E-mail 
Input validation
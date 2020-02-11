Instructions to run:

assuming that you have git and composer installed, as well as a server environment  set up to run the php then:

clone the repo down

run composer install

create a copy of the env file and fill in the db details to a local db you have set up for this 

inside the project folder run 'php artisan migrate'

Design considerations

when i first looked at the mark up and the requirements for this project i personally would have structured the editing a different way by having a seperate form to post to to add a employee and just have the table view the editable section


however i came up with something in between and have the delete function working off an ajax call and the edit and add posting on the same form to the same endpoint, within this i have added some logic to check if a new employee has been added and if so then validate them and do the checks on count

to try and keep things neater i hav seperated out the request validation into a different class, i have also tried not to repeat any code and have used fillable wher possible

The task took be about 9 hours to complete.
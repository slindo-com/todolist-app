<?php



function listsControllerTodo() {
  echo 'TODO: LISTS: TODO';
}



function listsControllerImportant() {
  echo 'TODO: LISTS: IMPORTANT';
}



function listsControllerToday() {
  echo 'TODO: LISTS: TODAY';
}



function listsControllerWeek() {
  echo 'TODO: LISTS: WEEK';
}



function listsControllerList() {
  echo 'TODO: LISTS: LIST';
}



function listsControllerAll() {
  render("lists/list", []);
}



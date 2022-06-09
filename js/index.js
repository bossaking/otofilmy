window.onload = () => {
    let movies = document.getElementsByClassName('movie-card');
    for (let movie of movies) {
        movie.addEventListener('click', () => {
            window.location = "movie.php?id=" + movie.id;
        });
    }


    let filterTitle = document.getElementById('filter-title');
    filterTitle.addEventListener('input', () => {
        let text = filterTitle.value;
        if (text === "") {
            for (let movie of movies) {
                movie.classList.remove('invisible');
            }
        } else {
            for (let movie of movies) {
                if (movie.children[1].children[0].innerHTML.toUpperCase().indexOf(text.toUpperCase()) === -1) {
                    movie.classList.add('invisible');
                } else {
                    movie.classList.remove('invisible');
                }
            }
        }
    });
}


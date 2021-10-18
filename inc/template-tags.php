<?php 


/*
* Wrapper functions to get specific data from TMDB API
*/
function get_all_tmdb_movies(string $page) {
    $tmdb_query = new TMDB_Query('discover/movie');

    $movies = $tmdb_query->filter_by(array(
        'region' => 'US',
        'page' => $page
    ))
    ->get_tmdb_data();

    return $movies;
}

function search_tmdb_actors(string $query) {
    $tmdb_query = new TMDB_Query('search/person');

    $actors = $tmdb_query->add_parameters(array(
        'query' => $query
    ))
    ->get_tmdb_data();

    return $actors;
}

function get_next_upcoming_movies() {
    $tmdb_query = new TMDB_Query('movie/upcoming');

    $movies = $tmdb_query->filter_by(
        array(
            'region' => 'US',
            'language' => 'en'
        )
    )
    ->get_tmdb_data();

    return count($movies['results']) > 10 ? array_slice($movies['results'], 0, 10) : $movies['results'];
}

function get_tmdb_person(string $id) {
    $tmdb_query = new TMDB_Query('person/' . $id);
    $actor = $tmdb_query->add_parameters(
        array(
            'append_to_response' => 'movie_credits,images'
        )
    )->get_tmdb_data();

    return $actor;
}

function get_most_popular_actors() {
    $tmdb_query = new TMDB_Query('person/popular');

    $actors = $tmdb_query->filter_by(
        array(
            'region' => 'US',
        )
    )
    ->get_tmdb_data();

    return count($actors['results']) > 10 ? array_slice($actors['results'], 0, 10) : $actors['results'];
}

function tmdb_search_people(string $query) {
    $tmdb_query = new TMDB_Query('search/person');

    $actors = $tmdb_query->add_parameters(
        array(
            'query' => $query
        )
    )
    ->get_tmdb_data();

    return $actors;
}

function get_poster_image(string $filename): string {
    return esc_url('https://image.tmdb.org/t/p/w500/' . $filename);
}

function get_all_genres() {
    $tmdb_query = new TMDB_Query('/genre/movie/list');
    $genres = $tmdb_query->get_tmdb_data();

    return $genres['genres'];
}

function get_movie_genres(array $genres_ids) {
    $tmdb_query = new TMDB_Query('/genre/movie/list');
    $genres_data = $tmdb_query
        ->add_parameters(array(
            'append_to_response' => 'images'
        ))
        ->get_tmdb_data();

    $genres = array_filter($genres_data['genres'], function($genre) use ($genres_ids) {
        return in_array($genre['id'], $genres_ids);
    });

    return $genres;
}

function get_tmdb_movie_detail($id) {
    $tmdb_query = new TMDB_Query('movie/' . $id);
    $movie_detail = $tmdb_query->add_parameters(
        array(
            'append_to_response' => 'videos,alternative_titles,credits,reviews, similar'
        )
    )->get_tmdb_data();

    return $movie_detail;
}

function get_tmdb_movie_random_trailer(array $videos) {
    $trailers = array_filter($videos, function($video) {
        return $video['type'] === 'Trailer';
    });

    shuffle($trailers);

    return $trailers[0];
}

function get_tmdb_language_name(string $lang_code) {
    $tmdb_query = new TMDB_Query('configuration/languages');
    $languages = $tmdb_query->get_tmdb_data();

    $lang_key = array_search($lang_code, array_column($languages, 'iso_639_1'));

    return esc_html($languages[$lang_key]['english_name']);
}

function filter_tmdb_movies(array $filters) {
    $tmdb_query = new TMDB_Query('discover/movie');
    $filtered_content = $tmdb_query->filter_by($filters)->get_tmdb_data();

    return $filtered_content;
}
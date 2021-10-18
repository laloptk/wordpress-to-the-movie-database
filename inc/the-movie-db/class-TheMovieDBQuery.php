<?php
class TMDB_Query {
    
    public $slug;

    public function __construct(string $slug) {
        $this->base_url = 'https://api.themoviedb.org/3/';
        $this->api_key = '7ec18bc5d16db404cfed3fbb230ef443';
        $this->api_url = $this->base_url . $slug . '?api_key=' . $this->api_key;
        return $this;
    }

    public function sort_by(string $value) {
        $this->api_url .= "&sort_by=" . $value;
        return $this;
    }

    public function filter_by(array $filters) {
        foreach($filters as $key => $value) {
            $this->api_url .= '&' . $key . '=' . $value;
        }

        return $this;
    }

    public function add_parameters(array $extras) {
        foreach($extras as $key => $value) {
            $this->api_url .= '&' . $key . '=' . $value;
        }

        return $this;
    }

    public function get_tmdb_data() {
        $data = file_get_contents($this->api_url);
        return json_decode($data, true);
    }
}
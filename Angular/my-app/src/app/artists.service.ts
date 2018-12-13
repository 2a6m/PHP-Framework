import { Injectable } from '@angular/core';
import { Artist } from './artist';
import { HttpClient, HttpHeader } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';

@Injectable
export class ArtistsService {

    artistURL = "http://localhost:8000/api/artiste";

    constructor(private http: HttpClient) { }

    getArtists () {
        return this.http.get(this.artistURL);
    }
}

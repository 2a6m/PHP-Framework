import { Injectable } from '@angular/core';
import { Artist } from 'src/app/artist';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ArtistsService {

    private artistURL = "http://localhost:8000/api/artiste";

    constructor(private http: HttpClient) { }

    getArtists(): Observable<Artist[]> {
        return this.http.get<Artist[]>(this.artistURL,  { responseType: 'json' });
    }
}

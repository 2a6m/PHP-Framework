import { Injectable } from '@angular/core';
import { Artist } from 'src/app/artist';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, ObservableInput } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ArtistsService {

    private artistURL = "http://localhost:8000/api/artiste";

    constructor(private http: HttpClient) { }

    getArtists(): Observable<Artist[]> {
        return this.http.get<Artist[]>(this.artistURL,  { responseType: 'json' });
    }

    deleteArtist(id): Observable<any> {
        return this.http.delete(this.artistURL + '/remove/' + id);
    }

    createArtist(artist: Artist): Observable<any> {
        const httpOptions = {
            headers: new HttpHeaders({ 'Content-Type': 'application/json'})
        };

        return this.http.post<Artist>(this.artistURL + '/add', artist, httpOptions);
    }

    updateArtist(artist: Artist): Observable<any> {
        const httpOptions = {
        headers: new HttpHeaders({ 'Content-Type': 'application/json' })
        };

        return this.http.put(this.artistURL + '/update/' + artist.id, artist, httpOptions);
    }
}

import { Injectable } from '@angular/core';
import { Music } from 'src/app/music';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, ObservableInput } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class MusicService {

    private musicURL = "http://localhost:8000/api/morceau"

    constructor(private http: HttpClient) { }

    getMusic(): Observable<Music[]> {
        return this.http.get<Music[]>(this.musicURL, { responseType: 'json'});
    }

    deleteMusic(id): Observable<any> {
        return this.http.delete(this.musicURL + '/remove/' + id);
    }

    createMusic(music: Music): Observable<any> {
        const httpOptions = {
            headers: new HttpHeaders({ 'Content-Type': 'application/json'})
        };

        return this.http.post<Music>(this.musicURL + '/add', music, httpOptions);
    }

    updateMusic(music: Music): Observable<any> {
        const httpOptions = {
        headers: new HttpHeaders({ 'Content-Type': 'application/json' })
        };

        return this.http.put(this.musicURL + '/update/' + music.id, music, httpOptions);
    }
}

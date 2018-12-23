import { Injectable } from '@angular/core';
import { Music } from 'src/app/music';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class MusicService {

    private musicURL = "http://localhost:8000/api/morceau"

    constructor(private http: HttpClient) { }

    getMusic(): Observable<Music[]> {
        return this.http.get<Music[]>(this.musicURL, { responseType: 'json'});
    }
}

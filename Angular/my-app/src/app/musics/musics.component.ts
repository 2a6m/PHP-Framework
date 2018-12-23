import { Component, OnInit } from '@angular/core';
import { Music } from 'src/app/music';
import { MusicService } from 'src/app/music.service';
import { Observable } from 'rxjs';

import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-musics',
  templateUrl: './musics.component.html',
  styleUrls: ['./musics.component.css']
})
export class MusicsComponent implements OnInit {
    selectedMusic: Music;
    lst_music: Music[];

    constructor(private musicservice: MusicService) { }

    ngOnInit() {
        this.loadMusic();
    }

    onSelect(music: Music): void {
        this.selectedMusic = music
    }

    loadMusic() {
        this.musicservice.getMusic().subscribe((data) => {
            console.log(data);
            this.lst_music = data;
        })
    }
}

import { Component, OnInit } from '@angular/core';
import { Music } from 'src/app/music';
import { MusicService } from 'src/app/music.service';
import { Router } from '@angular/router';
import { ArtistsService } from 'src/app/artists.service';
import { Artist } from 'src/app/artist';

@Component({
  selector: 'app-music-create',
  templateUrl: './music-create.component.html',
  styleUrls: ['./music-create.component.css']
})
export class MusicCreateComponent implements OnInit {
    newMusic: Music;
    lst_artist: Artist[];

    constructor(private router: Router, private musicservice: MusicService) {
        this.newMusic = new Music();
    }

    ngOnInit() {
    }

    onSubmit() {
        console.log(this.newMusic)
        this.musicservice.createMusic(this.newMusic).subscribe((data) => {
            console.log(data)
            if(data.status == true) {
                this.router.navigate(['/musics']);
            }
        })
    }

}

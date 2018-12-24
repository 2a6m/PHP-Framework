import { Component, OnInit, Input } from '@angular/core';
import { Music } from 'src/app/music';
import { MusicService } from 'src/app/music.service';
import { Observable } from 'rxjs';
import { Router } from '@angular/router';

@Component({
  selector: 'app-music-detail',
  templateUrl: './music-detail.component.html',
  styleUrls: ['./music-detail.component.css']
})
export class MusicDetailComponent implements OnInit {
    @Input() music: Music

    constructor(private router: Router, private musicservice: MusicService) { }

    ngOnInit() {

    }

    delete(id) {
        // don't refresh
        this.musicservice.deleteMusic(id).subscribe((data) => {
            console.log(data);
            if(data.status == true) {
                this.router.navigate(['']);
            }
        });
    }

    create() {
        this.router.navigate(['/music/create'])
    }

    onSubmit() {
        // don't refresh
        console.log(this.music)
        this.musicservice.updateMusic(this.music).subscribe((data) => {
            console.log(data);
            if(data.status == true) {
                this.router.navigate(['']);
            }
        });
    }
}

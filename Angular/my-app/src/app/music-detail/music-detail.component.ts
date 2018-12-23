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

  constructor() { }

  ngOnInit() {
  }

}

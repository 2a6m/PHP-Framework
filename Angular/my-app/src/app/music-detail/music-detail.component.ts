import { Component, OnInit, Input } from '@angular/core';
import { Music } from 'src/app/music';

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

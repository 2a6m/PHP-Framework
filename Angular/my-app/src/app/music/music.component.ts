import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-music',
  templateUrl: './music.component.html',
  styleUrls: ['./music.component.css']
})
export class MusicComponent implements OnInit {

  constructor() { }

  music = 'Behind blue eyes';

  ngOnInit() {
  }

}

import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-musics',
  templateUrl: './musics.component.html',
  styleUrls: ['./musics.component.css']
})
export class MusicsComponent implements OnInit {

  constructor() { }

  music = 'Behind blue eyes';

  ngOnInit() {
  }

}

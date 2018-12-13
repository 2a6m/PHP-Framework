import { Component, OnInit } from '@angular/core';
import { Artist } from '../artist';

@Component({
  selector: 'app-artists',
  templateUrl: './artists.component.html',
  styleUrls: ['./artists.component.css']
})
export class ArtistsComponent implements OnInit {
    lst_artist: Artist[]=[
        {
        id: 1,
        name: "example",
        birthdate: new Date("12/12/12"),
        gender: "Rock"}
    ];
    selectedArtist: Artist;

  constructor() { }

  ngOnInit() {
  }

    onSelect(artist: Artist): void {
        this.selectedArtist = artist;
    }

}

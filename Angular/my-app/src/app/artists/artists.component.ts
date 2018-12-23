import { Component, OnInit } from '@angular/core';
import { Artist } from 'src/app/artist';
import { ArtistsService } from 'src/app/artists.service';
import { Observable } from 'rxjs';

import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-artists',
  templateUrl: './artists.component.html',
  styleUrls: ['./artists.component.css']
})
export class ArtistsComponent implements OnInit {
    /*lst_artist: Artist[]=[
        {
        id: 1,
        name: "example",
        birthdate: new Date("12/12/12"),
        gender: "Rock"}
    ];*/
    selectedArtist: Artist;
    lst_artist :Artist[];

    constructor(private artistsservice: ArtistsService) { }

    ngOnInit() {
        this.loadArtist();
    }

    onSelect(artist: Artist): void {
        this.selectedArtist = artist;
    }

    loadArtist() {
        this.artistsservice.getArtists().subscribe((data) => {
            console.log(data);
            this.lst_artist = data;
        });
    }
}

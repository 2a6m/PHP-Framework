import { Component, OnInit } from '@angular/core';
import { Artist } from 'src/app/artist';
import { ArtistsService } from 'src/app/artists.service';
import { Observable } from 'rxjs';
import { Router } from '@angular/router';

import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-artists',
  templateUrl: './artists.component.html',
  styleUrls: ['./artists.component.css']
})
export class ArtistsComponent implements OnInit {
    selectedArtist: Artist;
    lst_artist: Artist[];

    constructor(private router: Router, private artistsservice: ArtistsService) { }

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

    delete(id) {
        // Delete artist but create an error and don't refresh
        this.artistsservice.deleteArtist(id).subscribe((data) => {
            console.log(data);
            if(data.status == true) {
                this.router.navigate(['/']);
            }
        });
    }

    create() {
        this.router.navigate(['/artist/create'])
    }
}

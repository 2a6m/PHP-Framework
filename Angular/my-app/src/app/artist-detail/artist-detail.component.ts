import { Component, OnInit, Input } from '@angular/core';
import { Artist } from 'src/app/artist';
import { ArtistsService } from 'src/app/artists.service';
import { Observable } from 'rxjs';
import { Router } from '@angular/router';

@Component({
  selector: 'app-artist-detail',
  templateUrl: './artist-detail.component.html',
  styleUrls: ['./artist-detail.component.css']
})
export class ArtistDetailComponent implements OnInit {
    @Input() artist: Artist;

    constructor(private router: Router, private artistsservice: ArtistsService) { }

    ngOnInit() {
    }

    delete(id) {
        // don't refresh
        this.artistsservice.deleteArtist(id).subscribe((data) => {
            console.log(data);
            if(data.status == true) {
                this.router.navigate(['']);
            }
        });
    }

    create() {
        this.router.navigate(['/artist/create'])
    }

    onSubmit() {
        // don't refresh
        console.log(this.artist)
        this.artistsservice.updateArtist(this.artist).subscribe((data) => {
            console.log(data);
            if(data.status == true) {
                this.router.navigate(['']);
            }
        });
    }
}

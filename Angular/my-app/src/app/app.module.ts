import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { MusicsComponent } from './musics/musics.component';
import { ArtistsComponent } from './artists/artists.component';
import { ArtistDetailComponent } from './artist-detail/artist-detail.component';
import { MusicDetailComponent } from './music-detail/music-detail.component';
import { ArtistCreateComponent } from './artist-create/artist-create.component';

@NgModule({
  declarations: [
    AppComponent,
    MusicsComponent,
    ArtistsComponent,
    ArtistDetailComponent,
    MusicDetailComponent,
    ArtistCreateComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }

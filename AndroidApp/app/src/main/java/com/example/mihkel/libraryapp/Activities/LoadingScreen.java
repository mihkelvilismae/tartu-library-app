package com.example.mihkel.libraryapp.Activities;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

import com.example.mihkel.libraryapp.Interfaces.ParseStringCallBackListener;
import com.example.mihkel.libraryapp.R;
import com.example.mihkel.libraryapp.Various.AppManagerSingleton;
import com.example.mihkel.libraryapp.Various.JsonTask;
import com.example.mihkel.libraryapp.Various.URLCreator;

public class LoadingScreen extends AppCompatActivity implements ParseStringCallBackListener {

    private static final Integer TYPE_AUTHORS = 0;
    private static final Integer TYPE_KEYWORDS = 1;
    private static final Integer TYPE_GENRES = 2;
    boolean isAuthorsDownloaded;
    boolean isKeywordsDownloaded;
    boolean isGenresDownloaded;




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_loading_screen);

        startLoadingScreen();
        startDownloadSequence();
    }

    private void startDownloadSequence() {
        downloadAuthors();
    }

    public void startLoadingScreen() {
        //show notification
        //download data (authors, keywords, genres)
        // set data
        //open next activity
    }

    public void downloadAuthors() {
        JsonTask jsonTask = new JsonTask(LoadingScreen.this, TYPE_AUTHORS).setListener(this);
        jsonTask.execute(URLCreator.getURL(URLCreator.URL_TYPE_AUTHORS));
    }

    public void downloadKeywords() {
        JsonTask jsonTask = new JsonTask(LoadingScreen.this, TYPE_KEYWORDS).setListener(this);
        jsonTask.execute(URLCreator.getURL(URLCreator.URL_TYPE_KEYWORDS));
    }

    public void downloadGenres() {
        JsonTask jsonTask = new JsonTask(LoadingScreen.this, TYPE_GENRES).setListener(this);
        jsonTask.execute(URLCreator.getURL(URLCreator.URL_TYPE_GENRES));
    }

    @Override
    public void callback(String string, Integer type) {
        if (type == TYPE_AUTHORS) {
            isAuthorsDownloaded = true;
//            saveAuthorsFromJSON();
            downloadKeywords();
        }
        if (type == TYPE_KEYWORDS) {
            isKeywordsDownloaded = true;
//            saveKeywordsFromJSON();
            downloadGenres();
        }
        if (type == TYPE_GENRES) {
//            saveGenresFromJSON = true;
            isGenresDownloaded = true;
            startNextActivity();
        }

    }

    //ecamples
    //ecamples
    //ecamples
    //ecamples

//    public void fetchDataFromServer() {
//        JsonTask jsonTask = new JsonTask(ClassesListActivity.this).setListener(this);
//        jsonTask.execute("http://admin-mihkelvilismae.rhcloud.com/AdminInterface/json/Nimekiri/"+ AppManagerSingleton.selectedClassId);
//    }

    public void startNextActivity() {
        Intent calendarStartIntent = new Intent(this, MainActivity.class);
        startActivity(calendarStartIntent);
    }
}

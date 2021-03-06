package com.example.mihkel.libraryapp.Activities;

import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.example.mihkel.libraryapp.Interfaces.ParseStringCallBackListener;
import com.example.mihkel.libraryapp.Item.Book;
import com.example.mihkel.libraryapp.Item.Item;
import com.example.mihkel.libraryapp.R;
import com.example.mihkel.libraryapp.Various.DatabaseManagerSingleton;
import com.example.mihkel.libraryapp.Various.JsonTask;
import com.example.mihkel.libraryapp.Various.URLCreator;

import java.util.HashMap;
import java.util.List;

public class MainActivity extends AppCompatActivity implements ParseStringCallBackListener, View.OnClickListener {

    public static final Integer TYPE_AUTHORS = 0;
    public static final Integer TYPE_KEYWORDS = 1;
    public static final Integer TYPE_GENRES = 2;
    boolean isAuthorsDownloaded;
    boolean isKeywordsDownloaded;
    boolean isGenresDownloaded;
    private TextView launchScreenText;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_loading_screen);

        if (isOnline())
            startDownloadSequence();
        else {
            launchScreenText = (TextView) findViewById(R.id.launchScreenText);
            launchScreenText.setText("Viga internetiühendusega, vajuta tekstile, et uuesti proovida");
            launchScreenText.setOnClickListener(this);
        }

    }

    @Override
    protected void onStart() {
        super.onStart();
        if (isAuthorsDownloaded & isGenresDownloaded & isKeywordsDownloaded)
            startNextActivity();
    }

    private void startDownloadSequence() {
        //show notification
        //download data (authors, keywords, genres)
        // set data
        //open next activity
        downloadAuthors();
    }

    public void downloadAuthors() {
        JsonTask jsonTask = new JsonTask(MainActivity.this, TYPE_AUTHORS).setListener(this);
        jsonTask.execute(URLCreator.getURL(URLCreator.URL_TYPE_AUTHORS));
    }

    public void downloadKeywords() {
        JsonTask jsonTask = new JsonTask(MainActivity.this, TYPE_KEYWORDS).setListener(this);
        jsonTask.execute(URLCreator.getURL(URLCreator.URL_TYPE_KEYWORDS));
    }

    public void downloadGenres() {
        JsonTask jsonTask = new JsonTask(MainActivity.this, TYPE_GENRES).setListener(this);
        jsonTask.execute(URLCreator.getURL(URLCreator.URL_TYPE_GENRES));
    }

    @Override
    public void callback(String JSONString, Integer type) {
        if (type == TYPE_AUTHORS) {
            isAuthorsDownloaded = true;
            saveAuthorsFromJSON(JSONString);
            downloadKeywords();
//            toast(JSONString);
        }
        if (type == TYPE_KEYWORDS) {
            isKeywordsDownloaded = true;
            saveKeywordsFromJSON(JSONString);
            downloadGenres();
//            toast(JSONString);
        }
        if (type == TYPE_GENRES) {
//            toast(JSONString);
            isGenresDownloaded = true;
            saveGenresFromJSON(JSONString);
            startNextActivity();
        }

    }

    private void saveGenresFromJSON(String JSONString) {
        //convert
        HashMap<Integer, String> genreData = DatabaseManagerSingleton.getInstance().parseIntegerKeyJsonToMap(JSONString);
        HashMap<Integer, Item> genreHashMap = DatabaseManagerSingleton.getInstance().stringHashMapToItemHashMap(genreData);
        //save
        DatabaseManagerSingleton.setGenreData(genreHashMap);
//        List<Item> xxx = DatabaseManagerSingleton.getInstance().stringHashMapToItemList(genreData);
//        DatabaseManagerSingleton.getInstance().setGenreData(genreData);
    }

    private void saveKeywordsFromJSON(String JSONString) {
        //convert
        HashMap<Integer, String> keywordsData = DatabaseManagerSingleton.getInstance().parseIntegerKeyJsonToMap(JSONString);
        HashMap<Integer, Item> keywordsHashMap = DatabaseManagerSingleton.getInstance().stringHashMapToItemHashMap(keywordsData);
        //save
        DatabaseManagerSingleton.setKeywordsData(keywordsHashMap);
    }

    private void saveAuthorsFromJSON(String JSONString) {
        //convert
        HashMap<Integer, String> authorsData = DatabaseManagerSingleton.getInstance().parseIntegerKeyJsonToMap(JSONString);
        HashMap<Integer, Item> authorsHashMap = DatabaseManagerSingleton.getInstance().stringHashMapToItemHashMap(authorsData);
        //save
        DatabaseManagerSingleton.setAuthorsData(authorsHashMap);
//        DatabaseManagerSingleton.getInstance().setAuthorsData(authorsData);
    }

    public boolean isOnline() {
        ConnectivityManager cm = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo netInfo = cm.getActiveNetworkInfo();
        if (netInfo != null && netInfo.isConnectedOrConnecting()) {
            return true;
        }
        return false;
    }

    //examples
    //examples
    //examples
    //examples

//    public void fetchDataFromServer() {
//        JsonTask jsonTask = new JsonTask(ClassesListActivity.this).setListener(this);
//        jsonTask.execute("http://admin-mihkelvilismae.rhcloud.com/AdminInterface/json/Nimekiri/"+ AppManagerSingleton.selectedClassId);
//    }

    public void startNextActivity() {
        Intent calendarStartIntent = new Intent(this, ModeSelectionScreen.class);
        startActivity(calendarStartIntent);
    }

    public void toast(String text) {
        Toast.makeText(getApplicationContext(), text, Toast.LENGTH_SHORT).show();
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.launchScreenText:
                if (isOnline())
                    startDownloadSequence();
                break;
        }
    }
}

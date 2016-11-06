package com.example.mihkel.libraryapp.Activities;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Toast;

import com.example.mihkel.libraryapp.Interfaces.ParseStringCallBackListener;
import com.example.mihkel.libraryapp.R;
import com.example.mihkel.libraryapp.Various.DatabaseManagerSingleton;
import com.example.mihkel.libraryapp.Various.JsonTask;

public class RecommendationActivity extends AppCompatActivity implements ParseStringCallBackListener {


    //------------------------------------------------------------------------------------------------------
    // DRAWING FIELDS start:
    //------------------------------------------------------------------------------------------------------
    public void showToLevel(int level) {
        if (level>=0)
            showAgeField();
        if (level>=1)
            showSexField();
        if (level>=2)
            showLikesReadingField();
        if (level>=3)
            showLanguageField();
        if (level>=4)
            showAuthorField();
        if (level>=5)
            showGenreField();
        if (level>=6)
            showYearField();
        if (level>=7)
            showPreviouslyLikedField();
        if (level>=8)
            showKeyWordsField();
    }

    public void showAgeField() {

    }

    public void showSexField() {

    }

    public void showLikesReadingField() {

    }

    public void showLanguageField() {

    }

    public void showAuthorField() {

    }

    public void showGenreField() {

    }

    public void showYearField() {

    }

    public void showPreviouslyLikedField() {

    }

    public void showKeyWordsField() {

    }

    //------------------------------------------------------------------------------------------------------
    // DRAWING FIELDS end
    //------------------------------------------------------------------------------------------------------

    public void onClick(View v) {
        toast("start");
//        switch (v.getId()) {
//            case R.id.startMandatoryReading:
//                startMandatoryReading();
//            case R.id.startRecommendation:
//                startRecommendationActivity();
//        }

    }

    public void startResultActivity() {
//        Intent calendarStartIntent = new Intent(this, SchoolsListActivity.class);
//        startActivity(calendarStartIntent);
//        toast("startRecommendationActivity");
    }

    public void startResult() {
//        if (true || !DatabaseManagerSingleton.getInstance().hasSchoolsList())
//            fetchDataFromServer();
//        else
//            startMandatoryReadingActivity();
    }

    public void toast(String text) {
        Toast.makeText(getApplicationContext(), text, Toast.LENGTH_SHORT).show();
    }

    public void fetchDataFromServer() {
//        JsonTask jsonTask = new JsonTask(RecommendationActivity.this).setListener(this);
//        jsonTask.execute("http://admin-mihkelvilismae.rhcloud.com/AdminInterface/json/Koolid");
    }

    @Override
    public void callback(String jsonString) {
//        DatabaseManagerSingleton.getInstance().setSchoolListResult(jsonString);
//        startMandatoryReadingActivity();
    }

    //-----------------------------------------------------------------------------------------------------------------------
    // DEFAULT start:
    //-----------------------------------------------------------------------------------------------------------------------
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_recommendation);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }


}

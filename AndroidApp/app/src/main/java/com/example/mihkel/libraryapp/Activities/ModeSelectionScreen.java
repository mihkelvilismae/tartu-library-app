package com.example.mihkel.libraryapp.Activities;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Toast;

import com.example.mihkel.libraryapp.Various.DatabaseManagerSingleton;
import com.example.mihkel.libraryapp.Interfaces.ParseStringCallBackListener;
import com.example.mihkel.libraryapp.Various.JsonTask;
import com.example.mihkel.libraryapp.R;

public class ModeSelectionScreen extends AppCompatActivity implements ParseStringCallBackListener {


    public void onClick(View v) {
//        toast("start");
        switch (v.getId()) {
            case R.id.startMandatoryReading:
                startMandatoryReading();
                break;
            case R.id.startRecommendation:
                startRecommendationActivity();
                break;
        }

    }

    public void startRecommendationActivity() {
        Intent calendarStartIntent = new Intent(this, RecommendationActivity.class);
        startActivity(calendarStartIntent);
//        toast("startRecommendationActivity");
    }

    public void startMandatoryReading() {
        if (true || !DatabaseManagerSingleton.getInstance().hasSchoolsList())
            fetchDataFromServer();
        else
            startMandatoryReadingActivity();
    }

    public void startMandatoryReadingActivity() {
        Intent calendarStartIntent = new Intent(this, SchoolsListActivity.class);
        startActivity(calendarStartIntent);
//        toast("startMandatoryReadingActivity");
    }

    public void toast(String text) {
        Toast.makeText(getApplicationContext(), text, Toast.LENGTH_SHORT).show();
    }

    public void fetchDataFromServer() {
        JsonTask jsonTask = new JsonTask(ModeSelectionScreen.this).setListener(this);
        jsonTask.execute("http://admin-mihkelvilismae.rhcloud.com/AdminInterface/json/Koolid");
    }

    @Override
    public void callback(String jsonString, Integer type) {
        DatabaseManagerSingleton.getInstance().setSchoolListResult(jsonString);
        startMandatoryReadingActivity();
    }

    //-----------------------------------------------------------------------------------------------------------------------
    // DEFAULT start:
    //-----------------------------------------------------------------------------------------------------------------------
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
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

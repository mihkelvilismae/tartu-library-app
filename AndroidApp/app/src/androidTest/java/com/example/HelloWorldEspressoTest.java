package com.example;

import android.support.test.filters.LargeTest;
import android.support.test.rule.ActivityTestRule;
import android.support.test.runner.AndroidJUnit4;

import com.example.mihkel.libraryapp.Activities.ModeSelectionScreen;
import com.example.mihkel.libraryapp.R;

import org.junit.Rule;
import org.junit.Test;
import org.junit.runner.RunWith;

import static android.support.test.espresso.Espresso.onView;
import static android.support.test.espresso.assertion.ViewAssertions.matches;
import static android.support.test.espresso.matcher.ViewMatchers.isDisplayed;
import static android.support.test.espresso.matcher.ViewMatchers.withId;
import static android.support.test.espresso.matcher.ViewMatchers.withText;

@RunWith(AndroidJUnit4.class)
@LargeTest
public class HelloWorldEspressoTest {

    @Rule
    public ActivityTestRule<ModeSelectionScreen> mActivityRule = new ActivityTestRule(ModeSelectionScreen.class);

    @Test
    public void listGoesOverTheFold() {
        onView(withId(R.id.startMandatoryReading)).check(matches(isDisplayed()));
    }
}